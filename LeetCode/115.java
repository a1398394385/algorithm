class Solution
{
    int sLen;
    int tLen;
    char[] sChar;
    char[] tChar;
    int[][] count;
    boolean[][] flag;

    public int numDistinct(String s, String t) {
        if (s == null || t == null) return 0;
        if ((sLen = s.length()) == 0 || (tLen = t.length()) == 0) return 0;
        sChar = s.toCharArray();
        tChar = t.toCharArray();
        count = new int[sLen][tLen];
        flag = new boolean[sLen][tLen];
        int result = 0;
        result += dp(0, 0);
        return result;
    }

    public int dp(int sIndex, int tIndex) {
        if (tIndex == tLen) return 1;
        if (sIndex == sLen) return 0;
        if (flag[sIndex][tIndex]) return count[sIndex][tIndex];
        int result = dp(sIndex + 1, tIndex);
        if (sChar[sIndex] == tChar[tIndex])
            result += dp(sIndex + 1, tIndex + 1);
        count[sIndex][tIndex] = result;
        flag[sIndex][tIndex] = true;
        return result;
    }
}
