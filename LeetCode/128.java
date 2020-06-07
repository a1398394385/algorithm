import java.util.HashMap;
import java.util.HashSet;
import java.util.Map;
import java.util.Set;

class Solution
{
    public Map<Integer, Integer> parent;

    public int longestConsecutive(int[] nums) {
        int length = nums.length;
        if (length == 0) return 0;
        parent = new HashMap<>();
        for (int i = 0; i < length; i++) {
            parent.put(nums[i], nums[i] - 1);
        }
        int result = 0;
        for (int i = 0; i < length; i++) {
            int len = nums[i] - find(nums[i]) + 1;
            result = len > result ? len : result;
        }
        return result;
    }

    public int find(int i) {
        if (parent.containsKey(parent.get(i)) == false)
            parent.put(i, i);
        int father = parent.get(i);
        if (father == i)
            return father;
        parent.put(i, find(father));
        return parent.get(i);
    }

    public static void main(String[] args) {
        Solution test = new Solution();
        System.out.println(test.longestConsecutive(new int[] {0, -1}));
    }

    public int longestConsecutive1(int[] nums) {
        Set<Integer> num_set = new HashSet<Integer>();
        for (int num : nums) {
            num_set.add(num);
        }

        int longestStreak = 0;
        for (int num : num_set) {
            if (!num_set.contains(num - 1)) {
                int currentNum = num;
                int currentStreak = 1;

                while (num_set.contains(currentNum + 1)) {
                    currentNum += 1;
                    currentStreak += 1;
                }

                longestStreak = Math.max(longestStreak, currentStreak);
            }
        }

        return longestStreak;
    }
}

