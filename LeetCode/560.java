import java.util.HashMap;
import java.util.Map;

class Solution
{
    public int subarraySum(int[] nums, int k) {
        int[] sum = new int[nums.length + 1];
        int result = 0;
        for (int i = 1; i <= nums.length; i++)
            sum[i] = sum[i - 1] + nums[i - 1];
        for (int i = 0; i < sum.length; i++)
            for (int j = i + 1; j < sum.length; j++)
                result += sum[j] - sum[i] == k ? 1 : 0;
        return result;
    }

    public int subarraySum1(int[] nums, int k) {
        int length = nums.length, result = 0;
        for (int i = 0; i < length; i++) {
            for (int j = i, sum = 0; j < length; j++) {
                sum += nums[j];
                result += sum == k ? 1 : 0;
            }
        }
        return result;
    }

    public int subarraySum2(int[] nums, int k) {
        int result = 0, sum = 0;
        Map<Integer, Integer> map = new HashMap<>();
        map.put(0, 1);
        for (int i : nums) {
            sum += i;
            result += map.containsKey(sum - k) ? map.get(sum - k) : 0;
            map.put(sum, map.containsKey(sum) ? map.get(sum) + 1 : 1);
        }
        return result;
    }

    public int subarraySum3(int[] nums, int k) {
        if (nums.length == 0) return 0;
        int max = nums[0], min = nums[0];
        for (int i = 1; i < nums.length; i++) {
            nums[i] += nums[i - 1];
            max = nums[i] > max ? nums[i] : max;
            min = nums[i] < min ? nums[i] : min;
        }
        int result = 0;
        int map[] = new int[max - min + 1];
        for (int i = 0; i < nums.length; i++) {
            if (nums[i] == k)
                result++;
            if (nums[i] - k >= min && nums[i] - k <= max)
                result += map[nums[i] - min - k];
            map[nums[i] - min]++;
        }
        return result;
    }
}
