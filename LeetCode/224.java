import java.util.Stack;

class Solution
{
    public int calculate(String s) {
        Stack<Integer> numStack = new Stack<>();
        Stack<Integer> symbolStack = new Stack<>();
        char[] chars = s.toCharArray();
        int num = 0, symbol = 1, length = chars.length;
        for (int i = 0; i < length; i++) {
            char c = chars[i];
            if (c == ' ') continue;
            if (c == '(') {
                numStack.push(num);
                symbolStack.push(symbol);
                num = 0;
                symbol = 1;
            } else if (c == ')') {
                num = numStack.pop() + symbolStack.pop() * num;
            } else if (c == '+' || c == '-') {
                symbol = c == '+' ? 1 : -1;
            } else {
                int temp = (c - '0');
                while (i + 1 < length && Character.isDigit(chars[i + 1])) {
                    temp = temp * 10 + (chars[++i] - '0');
                }
                num += temp * symbol;
                symbol = 1;
            }
        }
        return num;
    }
}
