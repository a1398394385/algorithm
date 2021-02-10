class Solution
{
    public int majorityElement(int[] nums) {
        int count = 0, result = 0;
        for (int i = 0; i < nums.length; i++) {
            if (count == 0) {
                count++;
                result = nums[i];
            } else {
                count += result == nums[i] ? 1 : -1;
            }
        }
        return result;
    }

    public int majorityElement1(int[] nums) {
        int result = nums[0], count = 1;
        for (int i = 1; i < nums.length; i++) {
            if (result == nums[i]) {
                count++;
            } else if (--count == 0) {
                result = nums[i];
                count = 1;
            }
        }
        return result;
    }
}

