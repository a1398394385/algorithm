import java.util.ArrayDeque;
import java.util.Deque;

public class Solution
{
    public static int clumsy(int N) {
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

    public static void main(String[] args) {
        System.err.println(clumsy(10));
    }
}
