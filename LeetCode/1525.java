import java.util.Arrays;

class Solution
{
    public static int waysToChange(int n) {
        int[] dp = new int[n + 1];
        dp[0] = 1;
        int[] coins = {1, 5, 10, 25};
        for (int coin : coins) {
            for (int i = coin; i <= n; i++) {
                dp[i] = (dp[i] + dp[i - coin]) % 1000000007;
            }
        }
        return dp[n];
    }

    public static int waysToChange1(int n) {
        n /= 5;
        int[] dp = new int[n + 1];
        Arrays.fill(dp, 1);
        int[] coins = {1, 2, 5};
        for (int coin : coins) {
            for (int i = coin; i <= n; i++) {
                dp[i] = (dp[i] + dp[i - coin]) % 1000000007;
            }
        }
        return dp[n];
    }

    public static int waysToChange2(int n) {
        int result = 0;
        int count = (n = n / 5) / 5;
        for (int i = 0, k; i <= count; i++) {
            k = (n - i * 5) / 2;
            result += (n - i * 5 + 1 - k) * (k + 1);
        }
        return result % 1000000007;
    }
}
