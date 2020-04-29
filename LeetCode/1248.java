import java.util.ArrayList;
import java.util.List;

class Solution
{
    public int numberOfSubarrays(int[] nums, int k) {
        int count = nums.length, result = 0, temp = 0;
        for (int p1 = 0, p2 = 0; p1 < count && p2 < count; p2++) {
            if ((nums[p2] & 1) == 1) {
                if (temp == 0) p1 = p2;
                temp++;
                if (temp == k) {
                    result += dp(nums, p1, p2);
                    p1++;
                    while (p1 < count && (nums[p1] & 1) == 0) p1++;
                    temp--;
                }
            }
        }
        return result;
    }

    public int dp(int[] nums, int p1, int p2) {
        int temp1 = p1 - 1;
        int temp2 = p2 + 1;
        while (temp1 >= 0 && (nums[temp1] & 1) == 0) temp1--;
        while (temp2 < nums.length && (nums[temp2] & 1) == 0) temp2++;
        return (p1 - temp1) * (temp2 - p2);
    }

    public int numberOfSubarrays1(int[] nums, int k) {
        List<Integer> map = new ArrayList<>();
        int evenCount = 0;
        for (int i = 0; i < nums.length; i++) {
            if ((nums[i] & 1) == 1) {
                map.add(evenCount);
                evenCount = 0;
            } else {
                evenCount++;
            }
        }
        map.add(evenCount);

        int sum = 0;
        for (int i = 0; i < map.size(); ++i) {
            if (i + k >= map.size()) continue;
            sum += (map.get(i) + 1) * (map.get(i + k) + 1);
        }
        return sum;
    }

    public int numberOfSubarrays2(int[] nums, int k) {
        int[] prefixCnt = new int[nums.length + 1];
        prefixCnt[0] = 1;
        int res = 0;
        int sum = 0;
        for (int num : nums) {
            sum += num & 1;
            prefixCnt[sum]++;
            if (sum >= k)
                res += prefixCnt[sum - k];
        }
        return res;
    }
}
