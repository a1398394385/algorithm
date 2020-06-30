import java.util.Stack;

class Solution
{
    public boolean isValid(String s) {
        Stack<Character> stack = new Stack<>();
        for (char c : s.toCharArray()) {
            if (c == ')' || c == ']' || c == '}') {
                if (stack.isEmpty()) return false;
                char prev = stack.pop();
                if ((c == ')' && prev != '(') || (c == ']' && prev != '[') || (c == '}' && prev != '{')) return false;
            } else {
                stack.push(c);
            }
        }
        return stack.isEmpty();
    }
}
