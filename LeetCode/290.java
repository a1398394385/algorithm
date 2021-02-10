import java.util.HashMap;
import java.util.Map;

class Solution
{
    public boolean wordPattern(String pattern, String s) {
        Map<Character, String> map = new HashMap<>();
        String[] strArr = s.split(" ");
        if (pattern.length() != strArr.length) return false;
        for (int i = 0; i < pattern.length(); i++) {
            if (!map.containsKey(pattern.charAt(i))) {
                if (map.containsValue(strArr[i])) return false;
                map.put(pattern.charAt(i), strArr[i]);
            } else {
                if (!map.get(pattern.charAt(i)).equals(strArr[i])) return false;
            }
        }
        return true;
    }


    public boolean wordPattern1(String pattern, String s) {
        String[] s1 = s.split(" ");
        if (pattern.length() != s1.length) return false;
        for (int i = 0; i < pattern.length(); i++) {
            if (pattern.indexOf(pattern.charAt(i)) != elementSite(s1, s1[i]))
                return false;
        }
        return true;
    }

    private static int elementSite(String[] s1, String s) {
        for (int i = 0; i < s1.length; i++) {
            if (s1[i].equals(s)) return i;
        }
        return -1;
    }
}
