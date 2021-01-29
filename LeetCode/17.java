import java.util.ArrayDeque;
import java.util.ArrayList;
import java.util.List;
import java.util.Queue;
import java.util.stream.Collectors;

class Solution {
    static final String[][] KEYS = { {}, {}, { "a", "b", "c" }, { "d", "e", "f" }, { "g", "h", "i" }, { "j", "k", "l" },
            { "m", "n", "o" }, { "p", "q", "r", "s" }, { "t", "u", "v" }, { "w", "x", "y", "z" } };

    private List<String> result = new ArrayList<>();

    public List<String> letterCombinations(String digits) {
        if (digits.trim().length() == 0)
            return new ArrayList<>();
        dp(digits.trim(), 0, "");
        return result;
    }

    private void dp(String digits, int index, String str) {
        if (index == digits.length()) {
            result.add(str);
            return;
        }
        int value = digits.charAt(index) - '0';
        for (String s : KEYS[value]) {
            dp(digits, index + 1, str + s);
        }
    }

    public List<String> letterCombinations1(String digits) {
        char[] chars = digits.trim().toCharArray();
        Queue<String> queue = new ArrayDeque<>();
        if (chars.length != 0)
            queue.add("");
        for (int i = 0, len = chars.length; i < len; ++i) {
            int value = chars[i] - '0';
            int size = queue.size();
            while (size-- > 0) {
                String str = queue.poll();
                for (String s : KEYS[value]) {
                    queue.add(str + s);
                }
            }
        }
        return queue.stream().collect(Collectors.toList());
    }

    public static void main(String[] args) {
        Long start = System.nanoTime();
        Solution solution = new Solution();
        solution.letterCombinations("5432");
        System.err.println(System.nanoTime() - start);
    }
}
