class Solution
{
    public int jump(int[] nums) {
        int count = nums.length;
        int result = 0, index = 0;
        while (index < count - 1) {
            if (nums[index] + index >= count - 1) return result + 1;
            int nextIndex = index;
            for (int i = 1; i <= nums[index]; i++) {
                if (index + i + nums[index + i] > nextIndex + nums[nextIndex])
                    nextIndex = index + i;
            }
            index = nextIndex;
            result += 1;
        }
        return result;
    }
}
