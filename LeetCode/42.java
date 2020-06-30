import java.util.Stack;

class Solution
{
    public static int trap(int[] height) {
        int count = height.length;
        int result = 0;
        Stack<int[]> stack = new Stack<>();
        for (int index = 0; index < count; index++) {
            int min = stack.isEmpty() ? Integer.MAX_VALUE : stack.peek()[0];
            if (height[index] == min) {
                stack.pop();
                stack.push(new int[] {height[index], index});
            } else if (height[index] < min) {
                stack.push(new int[] {height[index], index});
            } else {
                while (true) {
                    min = stack.pop()[0];
                    if (stack.isEmpty()) {
                        stack.push(new int[] {height[index], index});
                        break;
                    }
                    int[] last = stack.peek();
                    if (height[index] > last[0]) {
                        result += (last[0] - min) * (index - last[1] - 1);
                    } else {
                        result += (height[index] - min) * (index - last[1] - 1);
                        if (height[index] == last[0])
                            stack.pop();
                        stack.push(new int[] {height[index], index});
                        break;
                    }
                }
            }
        }
        return result;
    }

    public static int trap1(int[] height) {
        int count = height.length;

        int[] left = new int[count], right = new int[count];
        for (int i = 1; i < count; i++)
            left[i] = height[i - 1] > left[i - 1] ? height[i - 1] : left[i - 1];
        for (int i = count - 2; i >= 0; i--)
            right[i] = height[i + 1] > right[i + 1] ? height[i + 1] : right[i + 1];

        int result = 0;
        for (int i = 0; i < count; i++) {
            int min = left[i] < right[i] ? left[i] : right[i];
            result += min - height[i] > 0 ? min - height[i] : 0;
        }
        return result;
    }
}
