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
    public ListNode removeNthFromEnd(ListNode head, int n) {
        if (head == null | head.next == null) return null;
        ListNode fast = head, slow = head;
        for (int i = 0; i < n; i++) fast = fast.next;
        if (fast == null) return head.next;
        while (fast.next != null) {
            fast = fast.next;
            slow = slow.next;
        }
        slow.next = slow.next.next;
        return head;
    }

    int cur = 0;

    public ListNode removeNthFromEnd1(ListNode head, int n) {
        if (head == null) return null;
        head.next = removeNthFromEnd(head.next, n);
        cur++;
        if (n == cur) return head.next;
        return head;
    }
}
