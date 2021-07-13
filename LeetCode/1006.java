import java.util.ArrayDeque;
import java.util.Deque;

public class Solution
{
    public int clumsy(int n) {
        int[] special = new int[] {1, 2, 6, 7};
        int[] diff = new int[] {1, 2, 2, -1};
        if (n <= 4) return special[(n - 1) % 4];
        return n + diff[n % 4];
    }

    public int clumsy1(int N) {
        Deque<Integer> symbolStack = new ArrayDeque<>();
        Deque<Integer> numberStack = new ArrayDeque<>();
        numberStack.push(N);
        int index = 0;
        for (int i = N - 1; i >= 1; i--) {
            if (index == 4) index = 0;
            if (index == 0) {
                numberStack.push(numberStack.pop() * i);
            } else if (index == 1) {
                int temp = numberStack.pop();
                numberStack.push(Math.floorDiv(temp, i));
            } else {
                numberStack.push(i);
                symbolStack.push(index);
            }
            index += 1;
        }
        while (numberStack.size() > 1) {
            int a = numberStack.removeLast(), b = numberStack.removeLast();
            int symbol = symbolStack.removeLast();
            if (symbol == 2) {
                numberStack.addLast(a + b);
            } else {
                numberStack.addLast(a - b);
            }
        }
        return numberStack.pop();
    }
}
