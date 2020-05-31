import java.util.Arrays;
import java.util.List;

class Solution
{

    public static int cherryPickup(int[][] grid) {
        int rows = grid.length;
        int columns = grid[0].length;
        int[][][] dp = new int[rows][columns][columns];
        for (int i1 = 0; i1 < rows; i1++) {
            for (int i2 = 0; i2 < columns; i2++)
                Arrays.fill(dp[i1][i2], -1);
        }
        int result = grid[0][0] + grid[0][columns - 1];
        dp[0][0][columns - 1] = result;

        for (int row = 0; row < rows - 1; row++) {
            for (int l = 0; l < columns; l++) {
                for (int r = columns - 1; r >= 0; r--) {
                    if (dp[row][l][r] != -1) {
                        for (int lm = -1; lm < 2; lm++) {
                            for (int rm = -1; rm < 2; rm++) {
                                int xl = l + lm, xr = r + rm;
                                if (xl >= 0 && xl < columns && xr >= 0 && xr < columns) {
                                    int val = (xl == xr) ? grid[row + 1][xl] : grid[row + 1][xl] + grid[row + 1][xr];
                                    dp[row + 1][xl][xr] = Math.max(dp[row + 1][xl][xr], dp[row][l][r] + val);
                                }
                            }
                        }
                    }
                }
            }
        }

        for (int l = 0; l < columns; l++) {
            for (int r = 0; r < columns; r++)
                result = dp[rows - 1][l][r] > result ? dp[rows - 1][l][r] : result;
        }
        return result;
    }

    public static int cherryPickup1(int[][] grid) {
        int rows = grid.length;
        int columns = grid[0].length;
        int[][][] dp = new int[rows + 1][columns + 1][columns + 1];
        for (int i1 = 0; i1 < rows; i1++) {
            for (int i2 = 0; i2 < columns; i2++)
                Arrays.fill(dp[i1][i2], -1);
        }

        dp[0][0][columns - 1] = grid[0][0] + grid[0][columns - 1];
        int res = dp[0][0][columns - 1];
        for (int row = 1; row < rows; row++) {
            for (int l = 0; l < columns; l++) {
                for (int r = l + 1; r < columns; r++) {
                    for (int lm = -1; lm < 2; lm++) {
                        for (int rm = -1; rm < 2; rm++) {
                            int xl = l + lm, xr = r + rm;
                            if (xl >= xr || xl < 0 || xl >= columns || xr < 0 || xr >= columns) continue;
                            if (dp[row - 1][xl][xr] == -1) continue;
                            dp[row][l][r] = Math.max(dp[row][l][r], dp[row - 1][xl][xr] + grid[row][l] + grid[row][r]);
                        }
                    }
                    res = Math.max(res, dp[row][l][r]);
                }
            }
        }
        return res;
    }

    public static void main(String[] args) {
        // 24
        System.out.println(Solution.cherryPickup(new int[][] {{3, 1, 1}, {2, 5, 1}, {1, 5, 5}, {2, 1, 1}}));
        // 28
        System.out.println(
                Solution.cherryPickup(new int[][] {{1, 0, 0, 0, 0, 0, 1}, {2, 0, 0, 0, 0, 3, 0}, {2, 0, 9, 0, 0, 0, 0},
                        {0, 3, 0, 5, 4, 0, 0}, {1, 0, 2, 3, 0, 0, 6}}));
        // 22
        System.out
                .println(Solution.cherryPickup(new int[][] {{1, 0, 0, 3}, {0, 0, 0, 3}, {0, 0, 3, 3}, {9, 0, 3, 3}}));
        // 4
        System.out.println(Solution.cherryPickup(new int[][] {{1, 1}, {1, 1}}));
    }
}
