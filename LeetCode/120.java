import java.util.List;

class Solution
{
    public int minimumTotal(List<List<Integer>> triangle) {
        int len = triangle.size();
        int[] dp = triangle.get(len - 1).stream().mapToInt(Integer::valueOf).toArray();
        for (int deep = len - 1; deep >= 0; deep--) {
            for (int i = 0; i < deep; i++) {
                dp[i] = Math.min(dp[i], dp[i + 1]) + triangle.get(deep - 1).get(i);
            }
        }
        return dp[0];
    }

    public int minimumTotal1(List<List<Integer>> triangle) {
        int len = triangle.size();
        int[] dp = new int[len + 1];
        for (int deep = len; deep >= 0; deep--) {
            for (int i = 0; i < deep; i++) {
                dp[i] = Math.min(dp[i], dp[i + 1]) + triangle.get(deep - 1).get(i);
            }
        }
        return dp[0];
    }
}
