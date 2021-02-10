class Solution
{
    public boolean isPowerOfTwo(int n) {
        if (n <= 0) return false;
        if ((n & n - 1) == 0) return true;
        return false;
    }

    public boolean isPowerOfTwo1(int n) {
        return (n > 0) && (n & -n) == n;
    }
}
