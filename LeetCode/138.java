class Node
{
    int val;
    Node next;
    Node random;

    public Node(int val) {
        this.val = val;
        this.next = null;
        this.random = null;
    }
}


class Solution
{
    public Node copyRandomList(Node head) {
        if (head == null) return null;
        Node curr = head;
        while (curr != null) {
            Node node = new Node(curr.val);
            node.next = curr.next;
            curr.next = node;
            curr = node.next;
        }
        Node p1 = head, p2 = head.next;
        while (p1 != null) {
            if (p1.random != null)
                p2.random = p1.random.next;
            p1 = p2.next;
            if (p1 != null)
                p2 = p1.next;
        }
        Node result = head.next;
        p1 = head;
        p2 = head.next;
        while (p2.next != null) {
            p1 = p1.next = p2.next;
            p2 = p2.next = p1.next;
        }
        p1.next = p2.next = null;
        return result;
    }
}
