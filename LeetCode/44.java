class Solution
{
    public boolean isMatch(String s, String p) {
        if (s.equals("") && p.equals("")) return true;
        if (!s.equals("") && p.equals("")) return false;
        return name(s.toCharArray(), 0, p.toCharArray(), 0);
    }

    public boolean name(char[] string, int index1, char[] pattern, int index2) {
        if (index1 == string.length && index2 == pattern.length) return true;
        if (index1 != string.length && index2 == pattern.length) return false;
        if (index1 > string.length || index2 >= pattern.length) return false;

        if (index1 != string.length && (string[index1] == pattern[index2] || pattern[index2] == '?'))
            return name(string, index1 + 1, pattern, index2 + 1);
        if (pattern[index2] == '*')
            return name(string, index1 + 1, pattern, index2)
                    || name(string, index1, pattern, index2 + 1);
        return false;
    }

    public boolean isMatch1(String s, String p) {
        int m = s.length();
        int n = p.length();
        boolean[][] dp = new boolean[m + 1][n + 1];
        dp[0][0] = true;
        for (int i = 1; i <= n; ++i) {
            if (p.charAt(i - 1) == '*') {
                dp[0][i] = true;
            } else {
                break;
            }
        }
        for (int i = 1; i <= m; ++i) {
            for (int j = 1; j <= n; ++j) {
                if (p.charAt(j - 1) == '*') {
                    dp[i][j] = dp[i][j - 1] || dp[i - 1][j];
                } else if (p.charAt(j - 1) == '?' || s.charAt(i - 1) == p.charAt(j - 1)) {
                    dp[i][j] = dp[i - 1][j - 1];
                }
            }
        }
        return dp[m][n];
    }

    public boolean isMatch2(String s, String p) {
        int i = 0, j = 0, iBack = 0, jBack = -1, sLen = s.length(), pLen = p.length();
        char[] sArr = s.toCharArray(), pArr = p.toCharArray();
        while (i < sLen) {
            if (j < pLen && (sArr[i] == pArr[j] || pArr[j] == '?')) {
                i++;
                j++;
                continue;
            }
            if (j < pLen && pArr[j] == '*') {
                iBack = i;
                jBack = ++j;
                continue;
            }
            if (jBack != -1) {
                i = ++iBack;
                j = jBack;
                continue;
            }
            return false;
        }
        while (j < pLen && pArr[j] == '*') j++;
        return j == pLen;
    }
}
