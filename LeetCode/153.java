class Solution
{
    public int findMin(int[] nums) {
        int length = nums.length;
        if (nums[0] < nums[length - 1]) return nums[0];
        int min = nums[length - 1];
        for (int i = length - 2; i >= 0; i--) {
            if (nums[i] > min) return min;
            min = Math.min(nums[i], min);
        }
        return min;
    }
}
