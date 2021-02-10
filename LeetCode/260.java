class Solution
{
    public int[] singleNumber(int[] nums) {
        int num = 0, bit = 1;
        for (int i = 0; i < nums.length; i++) num ^= nums[i];
        while ((num & 1) == 0) {
            bit <<= 1;
            num >>= 1;
        }
        int num1 = 0, num2 = 0;
        for (int i = 0; i < nums.length; i++) {
            if ((nums[i] & bit) != 0)
                num1 ^= nums[i];
            else
                num2 ^= nums[i];
        }
        return new int[] {num1, num2};
    }
}
