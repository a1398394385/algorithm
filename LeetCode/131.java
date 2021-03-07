import java.util.ArrayList;
import java.util.LinkedList;
import java.util.List;

class Solution
{
    static List<List<String>> result;

    static int length;

    public static List<List<String>> partition(String s) {
        result = new ArrayList<>();
        if (s == null || s.isEmpty()) return result;
        length = s.length();
        dp(s.toCharArray(), 0, new ArrayList<>());
        return result;
    }

    public static void dp(char[] chars, int index, List<String> list) {
        if (index == length) result.add(new ArrayList<>(list));
        int size = list.size();
        for (int i = index; i < length; i++) {
            if (chars[i] != chars[index]) continue;
            if (isPalindrome(chars, index, i)) {
                list.add(String.valueOf(chars, index, i - index + 1));
                dp(chars, i + 1, list);
                list.remove(size);
            }
        }
    }

    public static boolean isPalindrome(char[] chars, int start, int end) {
        while (start < end) {
            if (chars[start++] != chars[end--]) return false;
        }
        return true;
    }
}
