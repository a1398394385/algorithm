public class Solution
{
    public int reverseBits(int n) {
        return Integer.reverse(n);
    }

    public int reverseBits1(int n) {
        int result = 0,i = 32;
        while (i-- > 0) {
            result <<= 1;
            result += n & 1;
            n >>= 1;
        }
        return result;
    }
}
