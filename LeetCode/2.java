
class Solution {
    public class ListNode {
        int val;
        ListNode next;

        ListNode(int x) {
            val = x;
        }
    }

    public ListNode addTwoNumbers(ListNode l1, ListNode l2) {
        int temp = 0;
        ListNode root = new ListNode(0);
        ListNode current = root;
        while (l1 != null || l2 != null || temp != 0) {
            int sum = temp;
            sum += l1 != null ? l1.val : 0;
            sum += l2 != null ? l2.val : 0;
            if (l1 != null)
                l1 = l1.next;
            if (l2 != null)
                l2 = l2.next;
            current.next = new ListNode(sum % 10);
            current = current.next;
            temp = sum / 10;
        }
        return root.next;
    }
}
