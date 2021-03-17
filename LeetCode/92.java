class ListNode
{
    int val;
    ListNode next;

    ListNode() {}

    ListNode(int val) {
        this.val = val;
    }

    ListNode(int val, ListNode next) {
        this.val = val;
        this.next = next;
    }
}


class Solution
{
    ListNode first, last;

    public ListNode reverseBetween(ListNode head, int left, int right) {
        if (head == null || head.next == null || left == right) return head;
        ListNode zero = new ListNode(0, head);
        first = zero;
        for (int i = 0; i < left - 1; i++) first = first.next;
        first.next = reverse(first.next, left, right);
        return zero.next;
    }

    public ListNode reverse(ListNode node, int deep, int right) {
        if (deep == right) {
            last = node.next;
            return node;
        }
        ListNode result = reverse(node.next, deep + 1, right);
        node.next.next = node;
        node.next = last;
        return result;
    }
}
