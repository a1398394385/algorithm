import java.util.ArrayDeque;
import java.util.Deque;

class Solution
{
    public int[] dailyTemperatures(int[] T) {
        int[] result = new int[T.length];
        Deque<int[]> stack = new ArrayDeque<>();
        for (int i = 0, len = T.length; i < len; i++) {
            while (stack.isEmpty() == false && T[i] > stack.peek()[1]) {
                int[] temp = stack.pop();
                result[temp[0]] = i - temp[0];
            }
            stack.push(new int[] {i, T[i]});
        }
        while (stack.isEmpty() == false) {
            int[] temp = stack.pop();
            result[temp[0]] = 0;
        }
        return result;
    }

    public int[] dailyTemperatures1(int[] T) {
        int[] res = new int[T.length];
        res[T.length - 1] = 0;
        for (int i = T.length - 2; i >= 0; i--) {
            for (int j = i + 1; j < T.length; j += res[j]) {
                if (T[i] < T[j]) {
                    res[i] = j - i;
                    break;
                } else if (res[j] == 0) {
                    res[i] = 0;
                    break;
                }
            }
        }
        return res;
    }
}
