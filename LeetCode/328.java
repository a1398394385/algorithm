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
    public ListNode oddEvenList(ListNode head) {
        if (head == null) return null;
        ListNode oldOdd = head, oldEven = head.next, odd = head, even = head.next;
        while (even != null && even.next != null) {
            odd = odd.next = even.next;
            even = even.next = odd.next;
        }
        odd.next = oldEven;
        return oldOdd;
    }
}
