class Solution
{
    public int rob(int[] nums) {
        int a = 0, b = 0, temp = 0;
        for (int i = 0, len = nums.length; i < len; i++) {
            temp = Math.max(b, a + nums[i]);
            a = b;
            b = temp;
        }
        return b;
    }

    public int rob1(int[] nums) {
        int n = nums.length;
        if (n == 0) { return 0; }
        if (n == 1) { return nums[0]; }
        int[] dp = new int[n];
        dp[0] = nums[0];
        dp[1] = Math.max(nums[0], nums[1]);
        for (int i = 2; i < n; i++) {
            dp[i] = Math.max(dp[i - 1], dp[i - 2] + nums[i]);
        }
        return dp[n - 1];
    }
}
