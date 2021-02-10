class Solution
{
    public int findRepeatNumber(int[] nums) {
        int length = nums.length;
        for (int i = 0; i < length; i++) {
            int index = nums[i] % length;
            if (nums[index] >= length) return index;
            nums[index] += length;
        }
        return 0;
    }

    public int findRepeatNumber1(int[] nums) {
        for (int i = 0; i < nums.length; i++) {
            while (nums[i] != i) {
                if (nums[nums[i]] == nums[i]) return nums[i];
                int tmp = nums[i];
                nums[i] = nums[tmp];
                nums[tmp] = tmp;
            }
        }
        return -1;
    }

    public int findRepeatNumber2(int[] nums) {
        int[] arr = new int[nums.length];
        for (int i = 0; i < nums.length; i++) {
            if (++arr[nums[i]] > 1) return nums[i];
        }
        return -1;
    }
}
