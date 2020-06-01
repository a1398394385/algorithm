class Solution
{
    public static int findLengthOfLCIS(int[] nums) {
        int result = 1, l = 0, r = 1, len = nums.length;
        if (len == 0) return 0;
        for (; r < len; r++) {
            if (nums[r] > nums[r - 1])
                result = (r - l + 1) > result ? (r - l + 1) : result;
            else
                l = r;
        }
        return result;
    }
}
