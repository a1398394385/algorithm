import java.util.Arrays;

class Solution
{
    int sum;
    boolean[] flag;

    public boolean canPartition(int[] nums) {
        sum = Arrays.stream(nums).sum();
        if ((sum & 1) == 1) return false;
        sum = sum >>> 1;
        Arrays.sort(nums);
        if (nums[nums.length - 1] > sum) return false;
        if (nums[nums.length - 1] == sum) return true;
        flag = new boolean[nums.length];
        return dfs(0, nums);
    }

    public boolean dfs(int num, int[] nums) {
        if (num == sum) return true;
        if (num > sum) return false;
        for (int i = nums.length - 1; i >= 0; i--) {
            if (flag[i] == false) {
                flag[i] = true;
                if (dfs(num + nums[i], nums)) return true;
                flag[i] = false;
            }
        }
        return false;
    }

    // 动态规划
    // dp[i][j] 表示从nums[0 - i]这段中是否满足有集合和为j
    // dp[i][j] = dp[i - 1][j] || dp[i - 1][j - nums[i]] || nums[i] == j;
    public boolean canPartition1(int[] nums) {
        if (nums.length == 0) return true;
        int sum = Arrays.stream(nums).sum();
        if (sum % 2 == 1) return false;
        int target = sum >>> 1;

        boolean[][] dp = new boolean[nums.length][target + 1];
        dp[0][0] = true;
        for (int i = 0; i < target + 1; i++) dp[0][i] = nums[0] == i;

        for (int i = 1; i < nums.length; ++i)
            for (int j = 1; j < target + 1; ++j)
                dp[i][j] = (dp[i - 1][j]) || (j - nums[i] >= 0 && dp[i - 1][j - nums[i]]);

        return dp[nums.length - 1][target];
    }


    public boolean canPartition2(int[] nums) {
        // 涉及到剪枝的问题，先排个序
        int sum = Arrays.stream(nums).sum();
        if ((sum & 1) == 1) return false;
        sum = sum >>> 1;
        return dfs(nums, nums.length - 1, sum, sum);
    }

    public boolean dfs(int[] nums, int index, int left, int right) {
        if (left == 0 || right == 0) return true;
        if (index < 0 || left < 0 || right < 0) return false;

        return dfs(nums, index - 1, left - nums[index], right)
                || dfs(nums, index - 1, left, right - nums[index]);
    }
}
