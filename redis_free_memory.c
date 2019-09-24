/** @link https://redis.io/topics/lru-cache

/* Check if we are over the memory usage limit. If we are not, no need
 * to subtract the slaves output buffers. We can just return ASAP. */
// 检查所使用内存是否超出内存限制.如果没有超出，则不需要减少服务的输出缓冲区
mem_reported = zmalloc_used_memory();
if (mem_reported <= server.maxmemory) return C_OK;

/* Remove the size of slaves output buffers and AOF buffer from the
 * count of used memory. */
mem_used = mem_reported;
size_t overhead = freeMemoryGetNotCountedMemory();
mem_used = (mem_used > overhead) ? mem_used-overhead : 0;

/* Check if we are still over the memory limit. */
if (mem_used <= server.maxmemory) return C_OK;

/* Compute how much memory we need to free. */
mem_tofree = mem_used - server.maxmemory;
mem_freed = 0;

if (server.maxmemory_policy == MAXMEMORY_NO_EVICTION)
    goto cant_free; /* We need to free memory, but policy forbids. */

latencyStartMonitor(latency);


cant_free:
    /* We are here if we are not able to reclaim memory. There is only one
     * last thing we can try: check if the lazyfree thread has jobs in queue
     * and wait... */
    while(bioPendingJobsOfType(BIO_LAZY_FREE)) {
        if (((mem_reported - zmalloc_used_memory()) + mem_freed) >= mem_tofree)
            break;
        usleep(1000);
    }
    return C_ERR;
