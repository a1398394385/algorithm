import java.util.HashMap;
import java.util.Map;

class Solution
{

    // 遇到奇偶个数校验，想到XOR
    // 遇到有限的参数（小于20个）表状态， 想到状态压缩 （bitmask）
    // 遇到求最长的连续子串使得和为k（maximum continuous subarray(substring) with sum equal to k）想到 前缀和 加哈希表记录第一次出现某一状态的位置。
    public int findTheLongestSubstring(String s) {
        Map<Character, Integer> VOWELS = new HashMap<>();
        VOWELS.put('a', 1);
        VOWELS.put('e', 2);
        VOWELS.put('i', 4);
        VOWELS.put('o', 8);
        VOWELS.put('u', 16);
        Map<Integer, Integer> map = new HashMap<>();
        map.put(0, -1);
        int result = 0, status = 0;
        for (int i = 0; i < s.length(); i++) {
            status ^= VOWELS.getOrDefault(s.charAt(i), 0);
            if (map.containsKey(status) == false) map.put(status, i);
            result = i - map.get(status) > result ? i - map.get(status) : result;
        }
        return result;
    }

    public int findTheLongestSubstring1(String s) {
        int[] VOWELS = new int[] {1, 0, 0, 0, 2, 0, 0, 0, 4, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 16, 0, 0, 0, 0, 0};
        int[] map = new int[32];
        for (int i = 0; i < 32; i++) map[i] = -2;
        map[0] = -1;
        int result = 0, status = 0;
        char[] chars = s.toCharArray();
        for (int i = 0, len = chars.length; i < len; i++) {
            status ^= VOWELS[chars[i] - 'a'];
            if (map[status] == -2) map[status] = i;
            result = i - map[status] > result ? i - map[status] : result;
        }
        return result;
    }
}
