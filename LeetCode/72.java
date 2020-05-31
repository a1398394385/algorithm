class Solution
{
    public int minDistance(String word1, String word2) {
        int len1 = word1.length(), len2 = word2.length();
        char[] chars1 = word1.toCharArray();
        char[] chars2 = word2.toCharArray();
        int[][] dp = new int[len1 + 1][len2 + 1];
        for (int i = 0; i <= len1; i++) dp[i][0] = i;
        for (int i = 0; i <= len2; i++) dp[0][i] = i;

        for (int x = 1; x <= len1; x++) {
            for (int y = 1; y <= len2; y++) {
                if (chars1[x - 1] == chars2[y - 1])
                    dp[x][y] = dp[x - 1][y - 1];
                else
                    dp[x][y] = 1 + Math.min(dp[x - 1][y - 1], Math.min(dp[x][y - 1], dp[x - 1][y]));
            }
        }

        return dp[len1][len2];
    }

    public int minDistance1(String word1, String word2) {
        int len1 = word1.length(), len2 = word2.length();
        char[] chars1 = word1.toCharArray();
        char[] chars2 = word2.toCharArray();
        int[] prev = new int[len2 + 1];
        int[] now = new int[len2 + 1];
        for (int i = 0; i <= len2; i++) prev[i] = i;
        for (int x = 1; x <= len1; x++) {
            now[0] = x;
            for (int y = 1; y <= len2; y++) {
                if (chars1[x - 1] == chars2[y - 1])
                    now[y] = prev[y - 1];
                else
                    now[y] = 1 + Math.min(prev[y], Math.min(prev[y - 1], now[y - 1]));
            }
            System.arraycopy(now, 0, prev, 0, len2 + 1);
        }
        return prev[len2];
    }

    public int minDistance2(String word1, String word2) {
        char[] chars1 = word1.toCharArray();
        char[] chars2 = word2.toCharArray();
        int prev = 0;
        int s1 = chars1.length;
        int s2 = chars2.length;
        int[] dp = new int[s2 + 1];
        for (int i = 1; i < s2 + 1; ++i)
            dp[i] = i;
        for (int i = 0; i < s1; ++i) {
            prev = i;
            dp[0] = i + 1;
            for (int j = 1; j <= s2; ++j)
                if (chars1[i] == chars2[j - 1]) {
                    int temp = dp[j];
                    dp[j] = prev;
                    prev = temp;
                } else
                dp[j] = Math.min(Math.min(prev, prev = dp[j]), dp[j - 1]) + 1;
        }
        return dp[s2];
    }
}
