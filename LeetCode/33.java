class Solution
{
    public int search(int[] nums, int target) {
        int length = nums.length;
        if (nums[0] < nums[length - 1] && (target < nums[0] || target > nums[length - 1]))
            return -1;
        int left = 0;
        int right = length - 1;

        while (left < right) {
            int mid = left + (right - left) >> 1;
            if (nums[mid] == target) return mid;
            if (nums[mid] < target) {
                if (nums[mid] <= nums[left] && nums[right] < target)
                    right = mid - 1;
                else
                    left = mid + 1;
            } else {
                if (nums[mid] >= nums[left] && nums[left] > target)
                    left = mid + 1;
                else
                    right = mid - 1;
            }
        }
        if (nums[left] == target)
            return left;
        return -1;
    }
}
