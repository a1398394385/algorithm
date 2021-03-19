class ListNode
{
    int val;
    ListNode next;

    ListNode(int x) {
        val = x;
        next = null;
    }
}


public class Solution
{
    public ListNode getIntersectionNode(ListNode headA, ListNode headB) {
        if (headA == null || headB == null) return null;
        ListNode pA = headA, pB = headB;
        while (pA != pB) {
            pA = pA == null ? headB : pA.next;
            pB = pB == null ? headA : pB.next;
        }
        return pA;
    }

    public ListNode getIntersectionNode1(ListNode headA, ListNode headB) {
        if (headA == null || headB == null) { return null; }
        // 分别计算两个链表的长度
        int len1 = 0;
        ListNode t1 = headA;
        while (t1 != null) {
            len1++;
            t1 = t1.next;
        }
        int len2 = 0;
        ListNode t2 = headB;
        while (t2 != null) {
            len2++;
            t2 = t2.next;
        }

        // 重置引用
        t1 = headA;
        t2 = headB;
        // 谁更长谁先走
        if (len1 > len2) {
            t1 = move(t1, len1 - len2);
        } else {
            t2 = move(t2, len2 - len1);
        }

        // 一起走，相等的时候，这就是答案
        while (t1 != t2) {
            t1 = t1.next;
            t2 = t2.next;
        }
        return t1;
    }

    public ListNode move(ListNode head, int i) {
        while (i > 0) {
            head = head.next;
            i--;
        }
        return head;
    }

}
