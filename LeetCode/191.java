public class Solution
{
    public int hammingWeight(int n) {
        int result = 0;
        boolean flag = false;
        if (n < 0) {
            flag = true;
            n = -n - 1;
        }
        while (n > 0) {
            result += n & 1;
            n >>= 1;
        }
        return flag ? 32 - result : result;
    }

    public int hammingWeight1(int n) {
        int count = 0;
        for (int i = 0; i < 32; i++) {
            count += (n >> i) & 1;
        }
        return count;
    }

    public int hammingWeight2(int n) {
        n = (n & 0x55555555) + ((n >> 1) & 0x55555555);
        n = (n & 0x33333333) + ((n >> 2) & 0x33333333);
        n = (n & 0x0f0f0f0f) + ((n >> 4) & 0x0f0f0f0f);
        n = (n & 0x00ff00ff) + ((n >> 8) & 0x00ff00ff);
        n = (n & 0x0000ffff) + ((n >> 16) & 0x0000ffff);
        return n;
    }

    public int hammingWeight3(int n) {
        int count = 0;
        int i = 0;
        while (i++ < 32) {
            if ((n & 1) == 0)
                count++;
            n = n >> 1;
        }
        return 32 - count;
    }
}
