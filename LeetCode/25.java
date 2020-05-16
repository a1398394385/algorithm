class ListNode
{
    int val;
    ListNode next;

    ListNode(int x) {
        val = x;
    }

    @Override
    public String toString() {
        ListNode node = this;
        do {
            System.out.println("ListNode val = " + node.val);
        } while ((node = node.next) != null);
        return "";
    }
}


class Solution
{
    public static ListNode reverseKGroup(ListNode root, int k) {
        if (root == null) return root;
        ListNode head = root;
        int i = 1;
        while (i < k && (head = head.next) != null) i++;
        if (i == k) {
            ListNode node = root, next = root.next;
            while (node != head) {
                ListNode temp = next.next;
                next.next = node;
                node = next;
                next = temp;
            }
            root.next = reverseKGroup(next, k);
            return head;
        }
        return root;
    }

    public static ListNode reverseKGroup1(ListNode head, int k) {
        ListNode dummy = new ListNode(0), prev = dummy, curr = head, next;
        dummy.next = head;
        int length = 0;
        for (; head != null; head = head.next) length++;

        for (int i = 0; i < length / k; i++) {
            for (int j = 0; j < k - 1; j++) {
                next = curr.next;
                curr.next = next.next;
                next.next = prev.next;
                prev.next = next;
            }
            prev = curr;
            curr = prev.next;
        }
        return dummy.next;
    }

    public static void main(String[] args) {
        ListNode root = new ListNode(1);
        root.next = new ListNode(2);
        root.next.next = new ListNode(3);
        root.next.next.next = new ListNode(4);
        root.next.next.next.next = new ListNode(5);
        Solution.reverseKGroup1(root, 2).toString();
    }
}
