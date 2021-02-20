import java.util.ArrayList;
import java.util.List;

class Solution
{
    List<Integer> findDisappearedNumbers(int[] nums) {
        for (int i = 0; i < nums.length; ++i)
            nums[Math.abs(nums[i]) - 1] = -Math.abs(nums[Math.abs(nums[i]) - 1]);
        List<Integer> res = new ArrayList<>();
        for (int i = 0; i < nums.length; ++i) {
            if (nums[i] > 0) res.add(i + 1);
        }
        return res;
    }

    public List<Integer> findDisappearedNumbers1(int[] nums) {
        boolean[] exists = new boolean[nums.length];
        for (int n : nums) exists[n - 1] = true;
        List<Integer> missing = new ArrayList<>(nums.length);
        for (int i = 0; i < exists.length; i++) {
            if (!exists[i]) missing.add(i + 1);
        }
        return missing;
    }
}
