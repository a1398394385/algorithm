class Solution
{
    public int maximumProduct(int[] nums) {
        int max1 = Integer.MIN_VALUE, max2 = Integer.MIN_VALUE, max3 = Integer.MIN_VALUE;
        int min1 = Integer.MAX_VALUE, min2 = Integer.MAX_VALUE;
        int temp;
        for (int i = 0; i < nums.length; i++) {
            temp = nums[i];
            if (temp > max3) {
                if (nums[i] > max1) {
                    max3 = max2;
                    max2 = max1;
                    max1 = temp;
                } else if (nums[i] > max2) {
                    max3 = max2;
                    max2 = temp;
                } else {
                    max3 = temp;
                }
            }

            if (temp < min2) {
                if (nums[i] < min1) {
                    min2 = min1;
                    min1 = temp;
                } else if (nums[i] < min2) {
                    min2 = temp;
                }
            }

        }
        return Math.max(max1 * max2 * max3, min1 * min2 * max1);
    }
}
