class Solution
{
    public int divide(int dividend, int divisor) {
        if (dividend == 0) return 0;
        if (divisor == 1) return dividend;
        if (divisor == -1) {
            if (dividend > Integer.MIN_VALUE) return -dividend;
            return Integer.MAX_VALUE;
        }
        long a = dividend, b = divisor;
        boolean sign = (dividend ^ divisor) < 0;
        a = (a < 0) ? -a : a;
        b = (b < 0) ? -b : b;
        long res = div(a, b);
        if (!sign) return res > Integer.MAX_VALUE ? Integer.MAX_VALUE : (int) res;
        return (int) -res;
    }

    long div(long a, long b) {
        if (a < b) return 0;
        long count = 1;
        long tb = b;
        while ((tb + tb) <= a) {
            count = count + count;
            tb = tb + tb;
        }
        return count + div(a - tb, b);
    }


    public int divide1(int dividend, int divisor) {
        if (dividend == 0) return 0;
        if (dividend == Integer.MIN_VALUE && divisor == -1) return Integer.MAX_VALUE;
        boolean negative;
        negative = (dividend ^ divisor) < 0;// 用异或来计算是否符号相异
        long t = Math.abs((long) dividend);
        long d = Math.abs((long) divisor);
        int result = 0;
        for (int i = 31; i >= 0; i--) {
            if ((d << i) <= t) {
                result += 1 << i;
                t -= d << i;
            }
        }
        return negative ? -result : result;
    }
};
