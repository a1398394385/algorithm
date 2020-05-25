import java.util.HashMap;
import java.util.Map;

class LRUCache
{
    static class Node
    {
        public int key;
        public int value;
        public Node prev = null;
        public Node next = null;

        public Node(int key, int value) {
            this.key = key;
            this.value = value;
        }
    }

    private int capacity;
    private int usedCapacity = 0;
    private Node head = new Node(0, 0);
    private Node tail = new Node(0, 0);
    private Map<Integer, Node> map = new HashMap<>();

    public LRUCache(int capacity) {
        this.capacity = capacity;
        this.head.next = tail;
        this.tail.prev = head;
    }

    private void insert(Node node) {
        tail.prev.next = node;
        node.prev = tail.prev;
        node.next = tail;
        tail.prev = node;
        usedCapacity++;
    }

    private void remove(Node node) {
        node.prev.next = node.next;
        node.next.prev = node.prev;
        usedCapacity--;
    }

    private void update(Node node) {
        remove(node);
        insert(node);
    }

    public int get(int key) {
        Node node = map.get(key);
        if (node == null) return -1;
        update(node);
        return node.value;
    }

    public void put(int key, int value) {
        Node oldNode = map.get(key);
        if (oldNode != null) {
            oldNode.value = value;
            update(oldNode);
            return;
        }
        Node newNode = new Node(key, value);
        if (usedCapacity == capacity) {
            map.remove(head.next.key);
            remove(head.next);
        }
        map.put(key, newNode);
        insert(newNode);
    }
}
