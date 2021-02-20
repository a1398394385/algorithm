class Solution
{
    public int findShortestSubArray(int[] nums) {
        if (nums.length <= 1) return nums.length;
        int[][] map = new int[50000][3];
        int num = 0, max = 0, result = Integer.MAX_VALUE;
        for (int i = 0; i < nums.length; i++) {
            num = Math.max(nums[i], num);
            max = Math.max(++map[nums[i]][0], max);
            if (nums[i] != nums[0] && map[nums[i]][1] == 0) map[nums[i]][1] = i;
            map[nums[i]][2] = i;
        }
        for (int i = 0; i <= num; i++) {
            if (map[i][0] == max) {
                result = Math.min(map[i][2] - map[i][1] + 1, result);
            }
        }
        return result;
    }
}
