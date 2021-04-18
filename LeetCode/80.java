class Solution
{
    public int removeDuplicates(int[] nums) {
        if (nums.length <= 2) return nums.length;
        int p1 = 0, p2 = 1;
        while (p2 < nums.length) {
            while (p2 < nums.length && nums[p2] != nums[p1]) nums[++p1] = nums[p2++];
            if (p2 < nums.length) nums[++p1] = nums[p2++];
            while (p2 < nums.length && nums[p2] == nums[p1]) p2++;
        }
        return p1 + 1;
    }

    // 1,1,1,2,2,3
    public int removeDuplicates1(int[] nums) {
        if (nums.length < 2) return nums.length;
        int index = 2;
        for (int i = 2; i < nums.length; i++) {
            if (nums[index - 2] != nums[i]) {
                nums[index++] = nums[i];
            }
        }
        return index;
    }
}
