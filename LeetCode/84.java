import java.util.Stack;

class Solution
{
    public int largestRectangleArea(int[] heights) {
        int result = 0;
        for (int i = 0, len = heights.length; i < len; i++) {
            for (int j = i, min = Integer.MAX_VALUE; j < len; j++) {
                min = Math.min(min, heights[j]);
                result = Math.max(result, min * (j - i + 1));
            }
        }
        return result;
    }

    // 单调递增栈
    public int largestRectangleArea1(int[] heights) {
        int[] list = new int[heights.length + 1];
        System.arraycopy(heights, 0, list, 0, heights.length);
        list[heights.length] = 0;
        Stack<Integer> stack = new Stack<>();
        int result = 0;
        for (int i = 0, len = list.length; i < len; i++) {
            while (!stack.isEmpty() && list[i] < list[stack.peek()]) {
                int curIndex = stack.pop();
                int acreage = list[curIndex] * (!stack.isEmpty() ? (i - stack.peek() - 1) : i);
                result = Math.max(result, acreage);
            }
            stack.push(i);
        }
        return result;
    }

    public int largestRectangleArea2(int[] heights) {
        if (heights == null || heights.length == 0) return 0;
        int n = heights.length;
        int[] left = new int[n];
        int[] right = new int[n];
        left[0] = -1;
        right[n - 1] = n;
        int result = 0, temp;
        // 左侧比当前柱子矮的第一根柱子的下标
        for (int i = 1; i < n; i++) {
            temp = i - 1;
            while (temp >= 0 && heights[temp] >= heights[i]) temp = left[temp];
            left[i] = temp;
        }
        // 右侧比当前柱子矮的第一根柱子的下标
        for (int i = n - 2; i >= 0; i--) {
            temp = i + 1;
            while (temp < n && heights[temp] >= heights[i]) temp = right[temp];
            right[i] = temp;
        }
        // right[i] - left[i] - 1 这个区间内所有柱子都比当前柱子高
        for (int i = 0; i < n; i++)
            result = Math.max(result, (right[i] - left[i] - 1) * heights[i]);
        return result;
    }
}
