class Solution
{
    public int maxSubArray(int[] nums) {
        int result = Integer.MIN_VALUE, sum = Integer.MIN_VALUE;
        for (int num : nums) {
            sum = sum < 0 ? num : sum + num;
            result = sum > result ? sum : result;
        }
        return result;
    }

    public int maxSubArray1(int[] nums) {
        int[] x = new int[2];
        int pre = 0;
        int maxAns = nums[0];
        for (int num : nums) {
            pre = Math.max(pre + num, num);
            maxAns = Math.max(maxAns, pre);
        }
        return maxAns;
    }
}
