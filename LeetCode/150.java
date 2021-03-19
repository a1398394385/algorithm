import java.util.ArrayDeque;
import java.util.Deque;

class Solution
{
    public int evalRPN(String[] tokens) {
        Deque<Integer> deque = new ArrayDeque<>();
        for (String token : tokens) {
            if (token.equals("+")) {
                deque.offerLast(deque.pollLast() + deque.pollLast());
            } else if (token.equals("-")) {
                deque.offerLast(-deque.pollLast() + deque.pollLast());
            } else if (token.equals("/")) {
                int temp1 = deque.pollLast();
                int temp2 = deque.pollLast();
                deque.offerLast(temp2 / temp1);
            } else if (token.equals("*")) {
                deque.offerLast(deque.pollLast() * deque.pollLast());
            } else {
                deque.offerLast(Integer.parseInt(token));
            }
        }
        return deque.peekFirst();
    }
}
