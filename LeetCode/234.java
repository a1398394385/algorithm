class ListNode
{
    int val;
    ListNode next;

    ListNode(int x) {
        val = x;
    }
}


class Solution
{
    public boolean isPalindrome(ListNode head) {
        if (head == null || head.next == null) return true;
        ListNode quick = head, slow = head;
        while (quick != null) {
            slow = slow.next;
            quick = quick.next == null ? quick.next : quick.next.next;
        }
        slow = reverseList(slow);
        while (slow != null) {
            if (head.val != slow.val) return false;
            head = head.next;
            slow = slow.next;
        }
        return true;
    }

    public ListNode reverseList(ListNode head) {
        if (head == null || head.next == null) return head;
        ListNode next = head.next;
        ListNode result = reverseList(next);
        head.next = null;
        next.next = head;
        return result;
    }
}
