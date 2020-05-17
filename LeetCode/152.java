class Solution
{
    public int maxProduct(int[] nums) {
        int result = Integer.MIN_VALUE, max = 1, min = 1;
        for (int i = 0; i < nums.length; i++) {
            if (nums[i] < 0) {
                int tmp = max;
                max = min;
                min = tmp;
            }
            max = max * nums[i];
            if (nums[i] > max) max = nums[i];
            min = min * nums[i];
            if (nums[i] < min) max = nums[i];

            result = max > result ? max : result;
        }
        return result;
    }

    public int maxProduct1(int[] nums) {
        int max = nums[0], length = nums.length;

        for (int i = 0, sum = 1; i < length; i++) {
            sum = sum * nums[i];
            if (sum > max) max = sum;
            if (nums[i] == 0) sum = 1;
        }

        for (int i = length - 1, sum = 1; i >= 0; i--) {
            sum = sum * nums[i];
            if (sum > max) max = sum;
            if (nums[i] == 0) sum = 1;
        }

        return max;
    }
}
