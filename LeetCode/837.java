class Solution
{
    double[] memo;

    public double new21Game(int N, int K, int W) {
        memo = new double[K];
        return dfs(N, K, W, 0);
    }

    public double dfs(int n, int k, int w, int cur) {
        if (cur >= k && cur <= n) return 1;
        if (cur > n) return 0;
        if (memo[cur] != 0) return memo[cur];
        double ans = 0;
        for (int i = 1; i <= w; i++) {
            ans += dfs(n, k, w, cur + i);
        }
        memo[cur] = ans / w;
        return memo[cur];
    }

    public double new21Game1(int N, int K, int W) {
        double[] dp = new double[K + W];
        double sum = 0;
        for (int i = K; i < K + W; i++) {
            dp[i] = i <= N ? 1D : 0D;
            sum += dp[i];
        }
        for (int i = K - 1; i >= 0; i--) {
            dp[i] = sum / W;
            sum += dp[i] - dp[i + W];
        }
        return dp[0];
    }
}
