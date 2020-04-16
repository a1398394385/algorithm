class Solution {
    public boolean canJump(int[] nums) {
        int length = nums.length;
        for (int i = 0; length > 1 && i < length - 1;) {
            if (nums[i] == 0)
                return false;
            int jump = 1;
            for (int j = 1, max = 0; j <= nums[i]; j++) {
                if (j + nums[i + j] > max) {
                    max = j + nums[i + j];
                    if (max + i >= length - 1)
                        return true;
                    jump = j;
                }
            }
            i += jump;
        }
        return true;
    }

    public boolean canJump1(int[] nums) {
        int length = nums.length - 1;
        for (int i = length - 1; i >= 0; i--) {
            if (i + nums[i] >= length)
                length = i;
        }
        return length == 0;
    }
}
