import java.util.Arrays;

class Solution
{
    public int threeSumClosest(int[] nums, int target) {
        Arrays.sort(nums);
        int result = nums[0] + nums[1] + nums[2];
        for (int i = 0; i < nums.length - 2; i++) {
            int left = i + 1, right = nums.length - 1;
            while (left < right) {
                int sum = nums[i] + nums[left] + nums[right];
                if (sum == target) return sum;
                if (sum < target)
                    left++;
                else
                    right--;
                if (Math.abs(sum - target) < Math.abs(result - target)) result = sum;
            }
        }
        return result;
    }

    public int threeSumClosest1(int[] nums, int target) {
        Arrays.sort(nums);
        int len = nums.length;
        if (target <= nums[0] + nums[1] + nums[2])
            return nums[0] + nums[1] + nums[2];
        if (target >= nums[len - 1] + nums[len - 2] + nums[len - 3])
            return nums[len - 1] + nums[len - 2] + nums[len - 3];

        int ans = Integer.MIN_VALUE;
        for (int i = 0; i < len - 2; i++) {
            if (i > 0 && nums[i] == nums[i - 1]) continue;
            int L = i + 1, R = len - 1;
            while (L < R) {
                int sum = nums[i] + nums[L] + nums[R];
                if (sum == target) return sum;

                int min = nums[i] + nums[L] + nums[L + 1];
                if (target < min) {
                    if (Math.abs(min - target) < Math.abs(ans - target))
                        ans = min;
                    break;
                }
                int max = nums[i] + nums[R] + nums[R - 1];
                if (target > max) {
                    if (Math.abs(max - target) < Math.abs(ans - target))
                        ans = max;
                    break;
                }

                if (Math.abs(target - sum) < Math.abs(target - ans))
                    ans = sum;
                if (sum > target)
                    while (L < R && nums[R - 1] == nums[R--]);
                else
                    while (L < R && nums[L + 1] == nums[L++]);
            }
        }
        return ans;
    }
}
