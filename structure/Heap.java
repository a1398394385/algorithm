import java.util.Stack;

/**
 * Heap
 */
public class Heap
{
    private int[] data;
    private int size;
    private int used;
    private boolean resize;

    public Heap(int capacity) {
        this(capacity, false);
    }

    public Heap(int capacity, boolean resize) {
        this.data = new int[capacity];
        this.size = capacity;
        this.used = 0;
        this.resize = resize;
    }

    public boolean push(int value) {
        if (used == size) return false;
        data[++used] = value;
        int index = used;
        while ((index >>> 1) > 0 && compare(value, data[index >>> 1]) > 0) {
            swap(index, index >>> 1);
            index = index >>> 1;
        }
        if (used == size - 1 && resize) expand();
        return true;
    }

    public int pop() {
        if (used == 0)
            throw new ArrayIndexOutOfBoundsException(0 + " >= " + used);
        int result = data[1];
        data[1] = data[used--];
        for (int point = 1;;) {
            int next = point, left = point << 1, right = (point << 1) + 1;
            if (left <= used && compare(data[left], data[next]) > 0)
                next = left;
            if (right <= used && compare(data[right], data[next]) > 0)
                next = right;
            if (next == point) break;
            swap(point, next);
            point = next;
        }
        return result;
    }

    @Override
    public String toString() {
        StringBuilder sbl = new StringBuilder().append("[Element: ").append(used).append(", Data: ");
        sbl.append(data[1]);
        for (int i = 2; i <= used; i++) {
            sbl.append(", ").append(data[i]);
        }
        sbl.append("]");
        return sbl.toString();
    }

    protected int compare(int num1, int num2) {
        return num1 - num2;
    }

    private void expand() {
        int oldSize = size;
        int newSize;
        if (Integer.MAX_VALUE - oldSize <= (oldSize >>> 1))
            newSize = Integer.MAX_VALUE;
        else
            newSize = oldSize + oldSize >>> 1;
        int[] newData = new int[newSize];
        System.arraycopy(data, oldSize, newData, 0, oldSize);
        size = newSize;
        data = newData;
    }


    private void swap(int index1, int index2) {
        int temp = data[index1];
        data[index1] = data[index2];
        data[index2] = temp;
    }
}
