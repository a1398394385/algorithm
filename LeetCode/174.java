import java.util.Arrays;

class Solution
{
    public int result;

    public int calculateMinimumHP(int[][] dungeon) {
        if (dungeon.length == 0 || dungeon[0].length == 0) return -1;
        result = Integer.MAX_VALUE;
        dfs(0, 0, 0, 1, dungeon);
        return result;
    }

    public void dfs(int x, int y, int value, int temp, int[][] paths) {
        if (x >= paths.length || y == paths[0].length) return;
        value += paths[x][y];
        if (value <= 0) temp = Math.max(Math.abs(value) + 1, temp);
        if (temp >= result) return;
        if (x == paths.length - 1 && y == paths[0].length - 1) result = temp < result ? temp : result;
        dfs(x + 1, y, value, temp, paths);
        dfs(x, y + 1, value, temp, paths);
    }

    public int calculateMinimumHP1(int[][] dungeon) {
        int row = dungeon.length;
        int col = dungeon[0].length;
        int[][] dp = new int[row][col];
        for (int i = row - 1; i >= 0; i--) {
            for (int j = col - 1; j >= 0; j--) {
                if (i == row - 1 && j == col - 1) {
                    dp[i][j] = Math.max(1, 1 - dungeon[i][j]);
                } else if (i == row - 1) {
                    dp[i][j] = Math.max(1, dp[i][j + 1] - dungeon[i][j]);
                } else if (j == col - 1) {
                    dp[i][j] = Math.max(1, dp[i + 1][j] - dungeon[i][j]);
                } else {
                    dp[i][j] = Math.max(1, Math.min(dp[i + 1][j], dp[i][j + 1]) - dungeon[i][j]);
                }
            }
        }
        return dp[0][0];
    }

    public int calculateMinimumHP2(int[][] dungeon) {
        int n = dungeon.length, m = dungeon[0].length;
        int[][] dp = new int[n + 1][m + 1];
        for (int i = 0; i <= n; ++i) {
            Arrays.fill(dp[i], Integer.MAX_VALUE);
        }
        dp[n][m - 1] = dp[n - 1][m] = 1;
        for (int i = n - 1; i >= 0; --i) {
            for (int j = m - 1; j >= 0; --j) {
                int minn = Math.min(dp[i + 1][j], dp[i][j + 1]);
                dp[i][j] = Math.max(minn - dungeon[i][j], 1);
            }
        }
        return dp[0][0];
    }

    int[][] memo;

    public int calculateMinimumHP3(int[][] dungeon) {
        memo = new int[dungeon.length][dungeon[0].length];
        return dfs(dungeon, dungeon.length, dungeon[0].length, 0, 0);
    }

    private int dfs(int[][] dungeon, int m, int n, int i, int j) {
        if (i == m - 1 && j == n - 1) { return Math.max(1 - dungeon[i][j], 1); }
        // 如果memo数组中有值，直接取出并返回，不进行后续的搜索。
        if (memo[i][j] > 0) { return memo[i][j]; }
        // 同解法一，向右搜+向下搜
        int minRes = 0;
        if (i == m - 1) {
            minRes = Math.max(dfs(dungeon, m, n, i, j + 1) - dungeon[i][j], 1);
        } else if (j == n - 1) {
            minRes = Math.max(dfs(dungeon, m, n, i + 1, j) - dungeon[i][j], 1);
        } else {
            minRes = Math.max(Math.min(dfs(dungeon, m, n, i + 1, j), dfs(dungeon, m, n, i, j + 1)) - dungeon[i][j], 1);
        }
        // 将结果存入memo数组
        return memo[i][j] = minRes;
    }
}
