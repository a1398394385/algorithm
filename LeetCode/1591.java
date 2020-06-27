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
    public ListNode removeDuplicateNodes(ListNode head) {
        if (head == null) return null;
        boolean[] cache = new boolean[20001];
        cache[head.val] = true;
        ListNode root = new ListNode(head.val);
        ListNode node = root;
        while ((head = head.next) != null) {
            if (cache[head.val] == false) {
                node.next = new ListNode(head.val);
                node = node.next;
                cache[head.val] = true;
            }
        }
        return root;
    }
}
