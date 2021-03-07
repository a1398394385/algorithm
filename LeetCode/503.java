import java.util.Arrays;
import java.util.Stack;

// 用单调栈求解，此处栈内记录的是 nums 元素的下标
// 直接将 nums 复制两倍
// 判断栈顶元素和当前元素的大小
// 若栈顶元素 > 当前元素：当前元素入栈
// 若栈顶元素 < 当前元素：弹出栈顶元素，并记录栈顶元素的下一个更大元素为当前元素
class Solution
{
    public int[] nextGreaterElements(int[] nums) {
        int n = nums.length;
        int[] res = new int[n];
        Arrays.fill(res, -1);
        Stack<Integer> stack = new Stack<>();
        for (int i = 0; i < n * 2; i++) {
            int num = nums[i % n];
            while (!stack.isEmpty() && num > nums[stack.peek()]) {
                res[stack.pop()] = num;
            }
            if (i < n) stack.add(i);
        }
        return res;
    }
}
