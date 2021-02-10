class Solution
{
    public int trailingZeroes(int n) {
        int count = 0;
        while (n >= 5) count += n /= 5;
        return count;
    }

    public int trailingZeroes1(int n) {
        return n < 5 ? 0 : (n / 5) + trailingZeroes1(n / 5);
    }
}
