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
}
