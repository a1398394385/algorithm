import java.util.HashMap;
import java.util.Map;

class Solution
{
    public int[] twoSum(int[] nums, int target) {
        if (nums.length == 0) return new int[0];
        Map<Integer, Integer> map = new HashMap<>();
        for (int i = 0; i < nums.length; i++)
            map.put(nums[i], i);

        for (int i = 0; i < nums.length; i++) {
            if (map.containsKey(target - nums[i])) {
                int index = map.get(target - nums[i]);
                if (index != i) return new int[] {i, index};
            }
        }
        return new int[0];
    }

    public int[] twoSum1(int[] nums, int target) {
        HashMap<Integer, Integer> map = new HashMap<>();
        for (int i = 0; i < nums.length; i++) {
            if (map.containsKey(target - nums[i])) {
                return new int[] {map.get(target - nums[i]), i};
            } else
                map.put(nums[i], i);
        }
        return null;
    }
}
