class Solution
{
    public int firstMissingPositive(int[] nums) {
        int length = nums.length;
        if (length == 0) return 1;
        for (int i = 0; i < length; i++) {
            int num = nums[i];
            if (num != i + 1 && 0 < num && num <= length && nums[num - 1] != num) {
                int temp = nums[num - 1];
                nums[num - 1] = num;
                nums[i] = temp;
                i--;
            }
        }
        for (int i = 0; i < length; i++)
            if (nums[i] != i + 1)
                return i + 1;
        return length + 1;
    }
}
