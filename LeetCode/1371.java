class LFUCache
{
    private final int size;

    private int usedSize = 0;

    private Node<Integer, Integer> head = null;

    private Node<Integer, Integer> end = null;

    static class Node<K, V>
    {
        final K key;
        V value;
        Node<K, V> prev;
        Node<K, V> next;

        public Node(K key, V value, Node<K, V> next, Node<K, V> prev) {
            this.key = key;
            this.value = value;
            this.next = next;
            this.prev = prev;
        }
    }

    public LFUCache(int capacity) {
        size = capacity;
    }

    public int get(int key) {
        return 1;
    }

    public void put(int key, int value) {
        Node<Integer, Integer> node = head;
        while (node != null) {
            if (node.key == key) {
                node.value = value;
                node.prev.next = node.next;
                node.prev = end;
                node.next = null;
                end.next = node;
                end = node;
                return;
            }
            node = node.next;
        }
    }
}
