class MyCircularQueue
{
    private int[] data;
    private int head;
    private int tail;
    private int size;
    private int used;

    /** Initialize your data structure here. Set the size of the queue to be k. */
    public MyCircularQueue(int k) {
        data = new int[k];
        head = 0;
        tail = -1;
        size = k;
        used = 0;
    }

    /**
     * Insert an element into the circular queue. Return true if the operation is
     * successful.
     */
    public boolean enQueue(int value) {
        if (used == size) return false;
        if (++tail == size) tail = 0;
        data[tail] = value;
        used++;
        return true;
    }

    /**
     * Delete an element from the circular queue. Return true if the operation is
     * successful.
     */
    public boolean deQueue() {
        if (used == 0) return false;
        if (++head == size) head = 0;
        used--;
        return true;
    }

    /** Get the front item from the queue. */
    public int Front() {
        if (used == 0) return -1;
        return data[head];
    }

    /** Get the last item from the queue. */
    public int Rear() {
        if (used == 0) return -1;
        return data[tail];
    }

    /** Checks whether the circular queue is empty or not. */
    public boolean isEmpty() {
        return used == 0;
    }

    /** Checks whether the circular queue is full or not. */
    public boolean isFull() {
        return used == size;
    }
}

