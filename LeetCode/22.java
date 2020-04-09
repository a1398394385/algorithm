import java.util.*;

class Solution {
    public List<String> generateParenthesis(int n) {
        List<String> result = new ArrayList<String>();
        helper(result, "", 0, 0, n);
        return result;
    }

    private void helper(List<String> result, String str, int left, int right, int n) {
        if (left > n || right > n || right > left) {
            return;
        }
        if (left == right && left == n) {
            result.add(str);
        }
        helper(result, str + "(", left + 1, right, n);
        helper(result, str + ")", left, right + 1, n);
    }
}
