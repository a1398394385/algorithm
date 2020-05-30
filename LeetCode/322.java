import java.util.Arrays;

class Solution
{
    public int coinChange(int[] coins, int amount) {
        return dp(coins, amount);
    }

    public int dp(int[] coins, int amount) {
        if (amount == 0) return 0;
        if (amount < 0) return -1;
        int result = Integer.MAX_VALUE;
        for (int coin : coins) {
            int subproblem = dp(coins, amount - coin);
            if (subproblem == -1) continue;
            result = result < subproblem + 1 ? result : subproblem + 1;
        }
        return result == Integer.MAX_VALUE ? -1 : result;
    }

    public int[] cache;

    public int coinChange1(int[] coins, int amount) {
        cache = new int[amount + 1];
        Arrays.fill(cache, -2);
        return dp1(coins, amount);
    }

    public int dp1(int[] coins, int amount) {
        if (amount == 0) return 0;
        if (amount < 0) return -1;
        if (cache[amount] != -2) return cache[amount];
        int result = Integer.MAX_VALUE;
        for (int coin : coins) {
            int subproblem = dp(coins, amount - coin);
            if (subproblem == -1) continue;
            result = result < subproblem + 1 ? result : subproblem + 1;
        }
        cache[amount] = result == Integer.MAX_VALUE ? -1 : result;
        return cache[amount];
    }

    public int coinChange2(int[] coins, int amount) {
        int[] dp = new int[amount + 1];
        Arrays.fill(dp, amount + 1);
        dp[0] = 0;
        for (int i = 1; i <= amount; i++) {
            for (int coin : coins) {
                if (i - coin < 0) continue;
                dp[i] = Math.min(dp[i], dp[i - coin] + 1);
            }
        }
        return dp[amount] == amount + 1 ? -1 : dp[amount];
    }

    private int ans = Integer.MAX_VALUE;

    public int coinChange3(int[] coins, int amount) {
        Arrays.sort(coins);
        dfs(coins, coins.length - 1, amount, 0);
        return ans == Integer.MAX_VALUE ? -1 : ans;
    }

    private void dfs(int[] coins, int index, int amount, int cnt) {
        if (index < 0) { return; }
        int i;
        for (i = amount / coins[index]; i > -1; i--) {
            int na = amount - i * coins[index];
            int ncnt = cnt + i;
            if (na == 0) {
                ans = Math.min(ans, ncnt);
                break;
            }
            if (ncnt + 1 >= ans) {
                break;
            }
            dfs(coins, index - 1, na, ncnt);
        }
    }
}
