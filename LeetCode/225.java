import java.util.ArrayList;
import java.util.List;

class MyStack
{

    private List<Integer> list;
    private int used;

    /** Initialize your data structure here. */
    public MyStack() {
        list = new ArrayList<>();
        used = 0;
    }

    /** Push element x onto stack. */
    public void push(int x) {
        list.add(x);
        used++;
    }

    /** Removes the element on top of the stack and returns that element. */
    public int pop() {
        return list.remove(--used);
    }

    /** Get the top element. */
    public int top() {
        return list.get(used - 1);
    }

    /** Returns whether the stack is empty. */
    public boolean empty() {
        return list.isEmpty();
    }
}
