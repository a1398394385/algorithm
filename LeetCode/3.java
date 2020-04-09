import java.util.Arrays;
import java.util.HashMap;

class Solution {
    public int lengthOfLongestSubstring(String s) {
        int max = 0, p1 = 0, p2 = 0;
        HashMap<Character, Integer> window = new HashMap<Character, Integer>();
        int length = s.length();
        for (; p2 < length; p2++) {
            if (window.containsKey(s.charAt(p2)) && window.get(s.charAt(p2)) >= p1) {
                max = Math.max(max, p2 - p1);
                p1 = window.get(s.charAt(p2)) + 1;
                window.replace(s.charAt(p2), p2);
            } else {
                window.put(s.charAt(p2), p2);
            }
        }
        return Math.max(max, p2 - p1);
    }

    public int lengthOfLongestSubstring1(String s) {
        int max = 0, p1 = 0, p2 = 0, map[] = new int[128];
        Arrays.fill(map, -1);
        for (; p2 < s.length(); p2++) {
            max = max > (p2 - p1) ? max : (p2 - p1);
            p1 = map[s.charAt(p2)] >= p1 ? map[s.charAt(p2)] + 1 : p1;
            map[s.charAt(p2)] = p2;
        }
        return max > (p2 - p1) ? max : (p2 - p1);
    }
}
