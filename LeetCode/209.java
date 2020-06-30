class Solution
{
    public int minSubArrayLen(int s, int[] nums) {
        int length = nums.length;
        if (length == 0 || s <= 0) return 0;
        int left = 0, right = 0, sum = nums[0], result = length + 1;
        for (;;) {
            if (sum < s) {
                if (right == length - 1) break;
                sum += nums[++right];
                continue;
            }
            result = Math.min(right - left + 1, result);
            sum -= nums[left++];
        }
        return result == length + 1 ? 0 : result;
    }

    public int minSubArrayLen1(int s, int[] nums) {
        if (nums == null || nums.length == 0) return 0;
        int result = nums.length + 1;
        int left = 0, sum = 0;
        for (int right = 0; right < nums.length; ++right) {
            sum += nums[right];
            while (sum >= s) {
                result = Math.min(right + 1 - left, result);
                sum -= nums[left++];
            }
        }
        return result == nums.length + 1 ? 0 : result;
    }
}
