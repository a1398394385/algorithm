
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
    public static ListNode reverseList(ListNode head) {
        ListNode e = head, result = null, next = null;
        while (e != null) {
            next = e.next;
            e.next = result;
            result = e;
            e = next;
        }
        return result;
    }

    public static ListNode reverseList1(ListNode head) {
        if (head == null || head.next == null) return head;
        ListNode next = head.next;
        ListNode result = reverseList(next);
        head.next = null;
        next.next = head;
        return result;
    }

    public static void main(String[] args) {
        ListNode node = new ListNode(1);
        node.next = new ListNode(2);
        node.next.next = new ListNode(3);
        ListNode result = Solution.reverseList1(node);
        while (result != null) {
            System.out.println(result.val);
            result = result.next;
        }
    }
}

