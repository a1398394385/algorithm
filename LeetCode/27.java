class Solution
{
    public int removeElement(int[] nums, int val) {
        if (nums.length == 0) return 0;
        if (nums.length == 1) return nums[0] == val ? 0 : 1;
        int l = 0, r = nums.length - 1, temp;
        while (l < r) {
            while (nums[l] != val && l < r) l++;
            while (nums[r] == val && r > l) r--;
            temp = nums[l];
            nums[l] = nums[r];
            nums[r] = temp;
        }
        return nums[l] == val ? l : l + 1;
    }
}
