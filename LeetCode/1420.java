class Solution
{
    private static final int MOD = 1000000007;

    // 我们生成一个三维数组dp，dp[i][j][p]代表符合长度为n、最大值确定为j，跳跃数为k这三个条件的数组个数。分两种情况
    // 如果最大值j在最後一位，那先将最後一位去掉，即长度为n-1，最大值比j小，跳跃数为k-1的所有数组，加上刚才的最後一位（已确定为j），都符合。
    // 方程：dp[i][j][p] += dp[i-1][1, j-1][p-1]
    // 如果最大值不在最後一位，那也将最後一位去掉，即长度为n-1，最大值为j，跳跃数为k的所有数组，加上刚才的最後一位（这一位可为任何不大于j的数），都符合。
    // 方程：dp[i][j][p] = dp[i-1][j][p] * j

    public int numOfArrays(int N, int M, int K) {
        if (M < K || N < K) return 0;
        long[][][] dp = new long[N + 1][M + 1][K + 1];
        for (int m = 1; m <= M; m++) {
            dp[1][m][1] = 1;
        }
        // O(N)
        for (int n = 2; n <= N; n++) {
            // O(N * K)
            for (int k = 1; k <= K; k++) {
                // O(N * K * M)
                for (int m = 1; m <= M; m++) {
                    dp[n][m][k] = (m * dp[n - 1][m][k]) % MOD;
                    // O(N * K * M^3)
                    for (int x = 1; x < m; x++)
                        dp[n][m][k] = (dp[n][m][k] + dp[n - 1][x][k - 1]) % MOD;
                }
            }
        }
        for (int m = 1; m <= M; m++) {
            for (int x = 1; x < m; x++);
        }

        long result = 0;
        for (int m = 1; m <= M; m++)
            result = (result + dp[N][m][K]) % MOD;
        return (int) result;
    }

    public int numOfArrays1(int N, int M, int K) {
        if (M < K || N < K) return 0;
        long[][][] dp = new long[N + 1][M + 1][K + 1];
        for (int m = 1; m <= M; m++) {
            dp[1][m][1] = 1;
        }
        long sum;
        for (int n = 2; n <= N; n++) {
            for (int k = 1; k <= K; k++) {
                sum = 0L;
                for (int m = 1; m <= M; m++) {
                    dp[n][m][k] = (m * dp[n - 1][m][k] + sum) % MOD;
                    sum += dp[n - 1][m][k - 1];
                }
            }
        }
        long result = 0;
        for (int m = 1; m <= M; m++)
            result = (result + dp[N][m][K]) % MOD;
        return (int) result;
    }

    public static int numOfArrays2(int N, int M, int K) {
        if (M < K || N < K) return 0;
        long[][] dp = new long[M + 1][K + 1];
        for (int m = 1; m <= M; m++) {
            dp[m][1] = 1;
        }
        long sum;
        for (int n = 2; n <= N; n++) {
            for (int k = K; k >= 1; k--) {
                sum = 0L;
                for (int m = 1; m <= M; m++) {
                    dp[m][k] = (m * dp[m][k] + sum) % MOD;
                    sum += dp[m][k - 1];
                }
            }
        }
        long result = 0;
        for (int m = 1; m <= M; m++)
            result = (result + dp[m][K]) % MOD;
        return (int) result;
    }

    public static int numOfArrays3(int N, int M, int K) {
        if (M < K || N < K) return 0;
        long[][] dp = new long[K + 1][M + 1];
        for (int m = 1; m <= M; m++)
            dp[1][m] = 1;
        long sum = 0L, result = 0L;
        for (int n = 2; n <= N; n++) {
            for (int k = (n < K ? n : K); k >= 1; k--) {
                sum = 0L;
                for (int m = M, num = K - k + 1; m >= num; m--) {
                    dp[k][m] = (m * dp[k][m] + sum) % MOD;
                    sum += dp[k - 1][m];
                }
            }
        }
        for (int m = 1; m <= M; m++)
            result = (result + dp[K][m]) % MOD;
        return (int) result;
    }

    public static void main(String[] args) {
        System.out.println(Solution.numOfArrays2(50, 100, 25));
        System.out.println(Solution.numOfArrays3(50, 100, 25));
    }

    public static int numOfArrays9(int n, int m, int k) {
        if (m < k || n < k) { return 0; }
        int[][] counts = new int[k + 1][m - k + 1];
        for (int i = 0; i <= m - k; i++) {
            counts[1][i] = 1;
        }
        for (int i = 2; i <= n; i++) {
            for (int j = k; j >= 1; j--) {
                long sum = 0;
                for (int l = 0; l <= m - k; l++) {
                    sum += counts[j - 1][l];
                    counts[j][l] = (int) (((long) (l + j) * counts[j][l] + sum) % MOD);
                }
            }
        }
        long sum = 0;
        for (int i = 0; i <= m - k; i++) {
            sum += counts[k][i];
        }
        return (int) (sum % MOD);
    }

}
