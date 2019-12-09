// MurmurHash3 => https://github.com/aappleby/smhasher/blob/master/src/MurmurHash3.cpp
unsigned int MurmurHash2(const void *key, int len)
{
    const unsigned int m = 0x5bd1e995;
    const int r = 24;
    const int seed = 97;
    unsigned int h = seed ^ len;
    // Mix 4 bytes at a time into the hash
    const unsigned char *data = (const unsigned char *)key;
    while (len >= 4)
    {
        unsigned int k = *(unsigned int *)data;
        k *= m;
        k ^= k >> r;
        k *= m;
        h *= m;
        h ^= k;
        data += 4;
        len -= 4;
    }
    // Handle the last few bytes of the input array
    // 处理输入数组的最后几个字节
    switch (len)
    {
    case 3:
        h ^= data[2] << 16;
    case 2:
        h ^= data[1] << 8;
    case 1:
        h ^= data[0];
        h *= m;
    };
    // Do a few final mixes of the hash to ensure the last few
    // bytes are well-incorporated.
    // 对散列进行最后几次混合，以确保最后几个字节得到很好的合并。
    h ^= h >> 13;
    h *= m;
    h ^= h >> 15;
    return h;
}
