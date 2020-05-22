import java.util.Arrays;

class Solution
{
    public int[][] cache;

    public static void main(String[] args) {

    }

    public int superEggDrop(int K, int N) {
        cache = new int[K + 1][N + 1];
        for (int k = 0; k <= K; k++) {
            for (int n = 0; n <= N; n++) {
                cache[k][n] = -1;
            }
        }
        return dp1(K, N);
    }

    public int dp(int K, int N) {
        if (K == 1)
            return N;
        if (N == 0)
            return 0;
        if (cache[K][N] != -1)
            return cache[K][N];
        int result = Integer.MAX_VALUE;
        for (int i = 1; i <= N; i++) {
            result = Math.min(result, Math.max(dp(K, N - i), dp(K - 1, i - 1)) + 1);
        }
        cache[K][N] = result;
        return result;
    }

    public int dp1(int K, int N) {
        if (K == 1)
            return N;
        if (N == 0)
            return 0;
        if (cache[K][N] != -1)
            return cache[K][N];
        int low = 1, high = N, result = Integer.MAX_VALUE;
        while (low <= high) {
            int mid = (low + high) >> 1;
            int broken = dp1(K - 1, mid - 1);
            int notBroken = dp1(K, N - mid);
            if (broken > notBroken) {
                high = mid - 1;
                result = Math.min(result, broken + 1);
            } else {
                low = mid + 1;
                result = Math.min(result, notBroken + 1);
            }
        }
        cache[K][N] = result;
        return result;
    }

    public int dp2(int K, int N) {
        int[] cache = new int[K + 1];
        Arrays.fill(cache, 0);
        int m = 0;
        for (; cache[K] < N; m++) {
            for (int k = K; k > 0; k--) {
                cache[k] = cache[k] + cache[k - 1] + 1;
            }
        }
        return m;
    }

    /**
     * 决策单调性
     * 
     * @param K 鸡蛋个数
     * @param N 楼层数
     * @return
     */
    public int dp3(int K, int N) {
        // Right now, dp[i] represents dp(1, i)
        int[] dp = new int[N + 1];
        for (int i = 0; i <= N; ++i)
            dp[i] = i;

        for (int k = 2; k <= K; ++k) {
            // Now, we will develop dp2[i] = dp(k, i)
            int[] dp2 = new int[N + 1];
            int x = 1;
            for (int n = 1; n <= N; ++n) {
                // Let's find dp2[n] = dp(k, n)
                // Increase our optimal x while we can make our answer better.
                // Notice max(dp[x-1], dp2[n-x]) > max(dp[x], dp2[n-x-1])
                // is simply max(T1(x-1), T2(x-1)) > max(T1(x), T2(x)).
                while (x < n && Math.max(dp[x - 1], dp2[n - x]) > Math.max(dp[x], dp2[n - x - 1]))
                    x++;

                // The final answer happens at this x.
                dp2[n] = 1 + Math.max(dp[x - 1], dp2[n - x]);
            }

            dp = dp2;
        }

        return dp[N];
    }

}
