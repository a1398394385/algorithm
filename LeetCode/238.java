import java.util.Arrays;

class Solution
{
    public int[] productExceptSelf(int[] nums) {
        int len = nums.length;
        int[] left = new int[len], right = new int[len];
        Arrays.fill(left, 1);
        Arrays.fill(right, 1);
        for (int i = 1; i < len; ++i)
            left[i] = left[i - 1] * nums[i - 1];
        for (int i = len - 2; i >= 0; --i)
            right[i] = right[i + 1] * nums[i + 1];
        int[] result = new int[len];
        for (int i = 0; i < len; ++i)
            result[i] = left[i] * right[i];
        return result;
    }

    public int[] productExceptSelf1(int[] nums) {
        int len = nums.length;
        int left = 1, right = 1;
        int[] result = new int[len];
        Arrays.fill(result, 1);
        for (int i = 0; i < len; ++i) {
            result[i] *= left;
            left *= nums[i];

            result[len - i - 1] *= right;
            right *= nums[len - i - 1];
        }
        return result;
    }
}
