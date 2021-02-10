class Solution
{
    public boolean canWinNim(int n) {
        return (n % 4 != 0);
    }

    // 巴什博奕 n%(m+1)!=0
    public boolean canWinNim1(int n) {
        return n % (3 + 1) != 0;
    }
}
