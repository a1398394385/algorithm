class Solution
{
    public int[] singleNumbers(int[] nums) {
        int temp = nums[0], index = 0;
        for (int i = 1; i < nums.length; i++) {
            temp ^= nums[i];
        }
        while ((temp & 1) == 0) {
            temp >>= 1;
            index += 1;
        }
        int num1 = 0, num2 = 0;
        for (int value : nums) {
            if (((value >> index) & 1) == 1)
                num1 ^= value;
            else
                num2 ^= value;
        }
        return new int[] {num1, num2};
    }

    public int[] singleNumbers1(int[] nums) {
        int sum = 0;
        for (int num : nums)
            sum ^= num;
        int flag = (-sum) & sum;
        int result[] = new int[2];
        for (int num : nums) {
            if ((flag & num) == 0)
                result[0] ^= num;
            else {
                result[1] ^= num;
            }
        }
        return result;
    }
}
