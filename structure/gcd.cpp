#include <bits/stdc++.h>

#define CHECK(a) (!(1 & (a))) //判断是否被2整除
#define CLEAN2(a)    \
    while (CHECK(a)) \
    a = a >>= 1 //移除非公因子的2
#define BIGERA \
    if (a < b) \
    (t = a, a = b, b = t) //取较大的数为a

/**
 * Stein 算法 循环实现
 */
int gcd(int a, int b)
{
    int c_2 = 0, t;
    while ((CHECK(a)) && (CHECK(b)))
    {
        a = a >>= 1;
        b = b >>= 1;
        c_2++;
    }
    CLEAN2(a);
    CLEAN2(b);
    BIGERA;
    while (a == ((a - b) >> 1))
    {
        CLEAN2(a);
        BIGERA;
    }
    return b << c_2;
}

/**
 * Stein 算法 递归实现
 */
int gcd(unsigned int x, unsigned int y)
{
    if (y > x)
        return gcd(y, x);
    if (!y)
        return x;
    if (!(x & 1))
    {
        if (!(y & 1))
            return gcd(x >> 1, y >> 1) << 1;
        else
            return gcd(x >> 1, y);
    }
    else
    {
        if (!(y & 1))
            return gcd(x, y >> 1);
        else
            return gcd((x - y) >> 1, y);
    }
}

/**
 * 辗转相除法(欧几里得算法)
 */
int gcd(int a, int b)
{
    if (a < b)
        std::swap(a, b);
    return b == 0 ? a : gcd(b, a % b);
}