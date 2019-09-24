/**
 * @link http://www.bubuko.com/infodetail-2709032.html
 * @link https://redis.io/topics/lru-cache
 */

int freeMemoryIfNeeded(void) {
    size_t mem_used, mem_tofree, mem_freed;
    int slaves = listLength(server.slaves);

    /* Remove the size of slaves output buffers and AOF buffer from the
     * count of used memory.
     */
     //计算占用内存大小时，并不计算slave output buffer和aof buffer，因此maxmemory应该比实际内存小，为这两个buffer留足空间。
    mem_used = zmalloc_used_memory();
    if (slaves) {
        listIter li;
        listNode *ln;

        listRewind(server.slaves,&li);
        while((ln = listNext(&li))) {
            redisClient *slave = listNodeValue(ln);
            unsigned long obuf_bytes = getClientOutputBufferMemoryUsage(slave);
            if (obuf_bytes > mem_used)
                mem_used = 0;
            else
                mem_used -= obuf_bytes;
        }
    }
    if (server.appendonly) {
        mem_used -= sdslen(server.aofbuf);
        mem_used -= sdslen(server.bgrewritebuf);
    }
//判断已经使用内存是否超过最大使用内存，如果没有超过就返回REDIS_OK，
    /* Check if we are over the memory limit. */
    if (mem_used <= server.maxmemory) return REDIS_OK;
	//当超过了最大使用内存时，就要判断此时redis到底采用的是那种内存释放策略，根据不同的策略，采取不同的手段。
	//（1）首先判断是否是为no-enviction策略，如果是，则返回REDIS_ERR,然后redis就不再接受任何写命令了。
    if (server.maxmemory_policy == REDIS_MAXMEMORY_NO_EVICTION)
        return REDIS_ERR; /* We need to free memory, but policy forbids. */

    /* Compute how much memory we need to free. */
    mem_tofree = mem_used - server.maxmemory;
    mem_freed = 0;
    //（2）接下来就判断淘汰策略是基于所有的键还是只是基于设置了过期时间的键，如果是针对所有的键，就从server.db[j].dict中取数据，如果是针对设置了过期时间的键，就从server.db[j].expires中取数据。
    while (mem_freed < mem_tofree) {
        int j, k, keys_freed = 0;

        for (j = 0; j < server.dbnum; j++) {
            long bestval = 0; /* just to prevent warning */
            sds bestkey = NULL;
            struct dictEntry *de;
            redisDb *db = server.db+j;
            dict *dict;
    //（3）然后判断是不是random策略，包括volatile-random 和allkeys-random，这两种策略是最简单的，就是在上面的数据集中随便去一个键，然后删掉。
            if (server.maxmemory_policy == REDIS_MAXMEMORY_ALLKEYS_LRU ||
                server.maxmemory_policy == REDIS_MAXMEMORY_ALLKEYS_RANDOM)
            {
                dict = server.db[j].dict;
            } else {
                dict = server.db[j].expires;
            }
            if (dictSize(dict) == 0) continue;
//接着又判断allkeys-random还是volatile-ttl策略
            /* volatile-random and allkeys-random policy */
            if (server.maxmemory_policy == REDIS_MAXMEMORY_ALLKEYS_RANDOM ||
                server.maxmemory_policy == REDIS_MAXMEMORY_VOLATILE_RANDOM)
            {
                de = dictGetRandomKey(dict);
                bestkey = dictGetEntryKey(de);
            }//如果是random delete,则从dict中随机选一个key
//然后就是判断是lru策略还是ttl策略，如果是lru策略就采用lru近似算法
            /* volatile-lru and allkeys-lru policy */
            else if (server.maxmemory_policy == REDIS_MAXMEMORY_ALLKEYS_LRU ||
                server.maxmemory_policy == REDIS_MAXMEMORY_VOLATILE_LRU)
            {
                for (k = 0; k < server.maxmemory_samples; k++) {
                    sds thiskey;
                    long thisval;
                    robj *o;

                    de = dictGetRandomKey(dict);
                    thiskey = dictGetEntryKey(de);
                    /* When policy is volatile-lru we need an additonal lookup
                     * to locate the real key, as dict is set to db->expires. */
                    if (server.maxmemory_policy == REDIS_MAXMEMORY_VOLATILE_LRU)
                        de = dictFind(db->dict, thiskey); //因为dict->expires维护的数据结构里并没有记录该key的最后访问时间
                    o = dictGetEntryVal(de);
                    thisval = estimateObjectIdleTime(o);

                    /* Higher idle time is better candidate for deletion */
                    if (bestkey == NULL || thisval > bestval) {
                        bestkey = thiskey;
                        bestval = thisval;
                    }
                }//为了减少运算量,redis的lru算法和expire淘汰算法一样，都是非最优解，lru算法是在相应的dict中，选择maxmemory_samples(默认设置是3)份key，挑选其中lru的，进行淘汰
            }
//如果是ttl策略。ttl策略很简单，就是取maxmemory_samples个键，然后比较他们的过期时间，然后从这些键中找到最快过期的那个键，就是我们将要删除的键。
            /* volatile-ttl */
            else if (server.maxmemory_policy == REDIS_MAXMEMORY_VOLATILE_TTL) {
                for (k = 0; k < server.maxmemory_samples; k++) {
                    sds thiskey;
                    long thisval;

                    de = dictGetRandomKey(dict);
                    thiskey = dictGetEntryKey(de);
                    thisval = (long) dictGetEntryVal(de);

                    /* Expire sooner (minor expire unix timestamp) is better
                     * candidate for deletion */
                    if (bestkey == NULL || thisval < bestval) {
                        bestkey = thiskey;
                        bestval = thisval;
                    }
                }//注意ttl实现和上边一样，都是挑选出maxmemory_samples份进行挑选
            }
//根据不同的策略，我们找到了将要删除的键，下面就是将他们删除的时候了，删除选定的键值对
            /* Finally remove the selected key. */
            if (bestkey) {
                long long delta;

                robj *keyobj = createStringObject(bestkey,sdslen(bestkey));
                // 发布数据更新消息，主要是AOF 持久化和从机
                propagateExpire(db,keyobj); //将del命令扩散给slaves

    // 注意， propagateExpire() 可能会导致内存的分配，
    // propagateExpire() 提前执行就是因为redis 只计算
    // dbDelete() 释放的内存大小。倘若同时计算dbDelete()
    // 释放的内存和propagateExpire() 分配空间的大小，与此
    // 同时假设分配空间大于释放空间，就有可能永远退不出这个循环。
    // 下面的代码会同时计算dbDelete() 释放的内存和propagateExpire() 分配空间的大小
                /* We compute the amount of memory freed by dbDelete() alone.
                 * It is possible that actually the memory needed to propagate
                 * the DEL in AOF and replication link is greater than the one
                 * we are freeing removing the key, but we can‘t account for
                 * that otherwise we would never exit the loop.
                 *
                 * AOF and Output buffer memory will be freed eventually so
                 * we only care about memory used by the key space. */
              // 只计算dbDelete() 释放内存的大小
                delta = (long long) zmalloc_used_memory();
                dbDelete(db,keyobj);
                delta -= (long long) zmalloc_used_memory();
                mem_freed += delta;
                server.stat_evictedkeys++;
                decrRefCount(keyobj);
                keys_freed++;

                /* When the memory to free starts to be big enough, we may
                 * start spending so much time here that is impossible to
                 * deliver data to the slaves fast enough, so we force the
                 * transmission here inside the loop. */
                 // 将从机回复空间中的数据及时发送给从机
                if (slaves) flushSlavesOutputBuffers();
            }
        }//在所有的db中遍历一遍，然后判断删除的key释放的空间是否足够，未能释放空间，且此时redis 使用的内存大小依旧超额，失败返回
        if (!keys_freed) return REDIS_ERR; /* nothing to free... */
    }
    return REDIS_OK;
}





// /* Check if we are over the memory usage limit. If we are not, no need
//  * to subtract the slaves output buffers. We can just return ASAP. */
// // 检查所使用内存是否超出内存限制.如果没有超出，则不需要减少服务的输出缓冲区
// mem_reported = zmalloc_used_memory();
// if (mem_reported <= server.maxmemory) return C_OK;

// /* Remove the size of slaves output buffers and AOF buffer from the
//  * count of used memory. */
// mem_used = mem_reported;
// size_t overhead = freeMemoryGetNotCountedMemory();
// mem_used = (mem_used > overhead) ? mem_used-overhead : 0;

// /* Check if we are still over the memory limit. */
// if (mem_used <= server.maxmemory) return C_OK;

// /* Compute how much memory we need to free. */
// mem_tofree = mem_used - server.maxmemory;
// mem_freed = 0;

// if (server.maxmemory_policy == MAXMEMORY_NO_EVICTION)
//     goto cant_free; /* We need to free memory, but policy forbids. */

// latencyStartMonitor(latency);


// cant_free:
//     /* We are here if we are not able to reclaim memory. There is only one
//      * last thing we can try: check if the lazyfree thread has jobs in queue
//      * and wait... */
//     while(bioPendingJobsOfType(BIO_LAZY_FREE)) {
//         if (((mem_reported - zmalloc_used_memory()) + mem_freed) >= mem_tofree)
//             break;
//         usleep(1000);
//     }
//     return C_ERR;
