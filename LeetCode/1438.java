import java.util.TreeMap;

class Solution
{
    public int longestSubarray(int[] nums, int limit) {
        TreeMap<Integer, Integer> treeMap = new TreeMap<>();
        int left = 0, right = 0, temp = 0, length = nums.length;
        while (right < length) {
            treeMap.put(nums[right], treeMap.getOrDefault(nums[right], 0) + 1);
            if (treeMap.lastKey() - treeMap.firstKey() > limit) {
                temp = treeMap.put(nums[left], treeMap.get(nums[left]) - 1);
                if (temp == 1) treeMap.remove(nums[left]);
                left++;
            }
            right++;
        }
        return right - left;
    }
}
