import java.util.Arrays;

class Solution
{
    // 要求最多买卖两次，那么每天都会有五种状态：不买、买一次、卖一次、买两次、卖两次。
    // 而这五种状态赚的钱的转换规律为：

    // 总不买 = 0；
    // 买一次 = 买过一次，这次不卖或者没买过， 这次买。
    // 卖一次 = 卖过一次，这次不买或者买过一次，这次卖。
    // 买两次 = 买过两次，这次不卖或者卖过一次，这次买。
    // 卖两次 = 卖过两次，没机会了或者买过两次，这次卖。
    public int maxProfit(int[] prices) {
        long[][] dp = new long[prices.length + 1][5];
        for (long[] dayStatus : dp) {
            Arrays.fill(dayStatus, Integer.MIN_VALUE);
        }
        dp[0][0] = 0; // 第零天的“没买过”状态的收入值是 0，其他都为 Integer.MIN_VALUE 表示没计算过
        for (int i = 1; i < dp.length; i++) {
            dp[i][0] = 0;
            dp[i][1] = Math.max(dp[i - 1][1], dp[i - 1][0] - prices[i - 1]);
            dp[i][2] = Math.max(dp[i - 1][2], dp[i - 1][1] + prices[i - 1]);
            dp[i][3] = Math.max(dp[i - 1][3], dp[i - 1][2] - prices[i - 1]);
            dp[i][4] = Math.max(dp[i - 1][4], dp[i - 1][3] + prices[i - 1]);
        }
        int res = Integer.MIN_VALUE;
        for (int i = 0; i < dp[prices.length].length; i++) {
            res = Math.max(res, (int) dp[prices.length][i]);
        }
        return res;
    }

    public int maxProfit1(int[] prices) {
        int n = prices.length;
        int buy1 = -prices[0], sell1 = 0;
        int buy2 = -prices[0], sell2 = 0;
        for (int i = 1; i < n; ++i) {
            buy1 = Math.max(buy1, 0 - prices[i]);
            sell1 = Math.max(sell1, buy1 + prices[i]);
            buy2 = Math.max(buy2, sell1 - prices[i]);
            sell2 = Math.max(sell2, buy2 + prices[i]);
        }
        return sell2;
    }
}
