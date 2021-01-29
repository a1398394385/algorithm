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

    public ListNode addTwoNumbers1(ListNode l1, ListNode l2) {
        ListNode root = new ListNode(0);
        ListNode node = root;
        int temp = 0;
        while (l1 != null || l2 != null) {
            int sum = temp;
            temp = 0;
            if (l1 != null) {
                sum += l1.val;
                l1 = l1.next;
            }
            if (l2 != null) {
                sum += l2.val;
                l2 = l2.next;
            }
            if (sum >= 10) {
                sum -= 10;
                temp = 1;
            }
            node = node.next = new ListNode(sum);
        }
        if (temp == 1) node.next = new ListNode(1);
        return root.next;
    }
}
