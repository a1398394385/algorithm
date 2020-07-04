import java.util.PriorityQueue;
import java.util.Queue;

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
    public ListNode mergeKLists(ListNode[] lists) {
        if (lists.length == 0 || !(lists[0] instanceof ListNode)) return null;
        Queue<Integer> queue = new PriorityQueue<>((Integer newValue, Integer oldValue) -> {
            return newValue - oldValue;
        });
        for (int i = 0; i < lists.length; i++) {
            while (lists[i] != null && lists[i] instanceof ListNode) {
                queue.add(lists[i].val);
                lists[i] = lists[i].next;
            }
        }

        ListNode result = new ListNode(queue.poll());
        ListNode node = result;
        while (queue.size() != 0) {
            node.next = new ListNode(queue.poll());
            node = node.next;
        }
        return result;
    }

    public ListNode mergeKLists1(ListNode[] lists) {
        if (lists.length == 0) return null;
        if (lists.length == 1) return lists[0];
        if (lists.length == 2) return mergeList(lists[0], lists[1]);

        int mid = lists.length / 2;
        ListNode[] l1 = new ListNode[mid];
        ListNode[] l2 = new ListNode[lists.length - mid];
        for (int i = 0; i < mid; i++)
            l1[i] = lists[i];
        for (int i = mid, j = 0; i < lists.length; i++, j++)
            l2[j] = lists[i];
        return mergeList(mergeKLists(l1), mergeKLists(l2));
    }

    public ListNode mergeList(ListNode l1, ListNode l2) {
        ListNode dummyHead = new ListNode(0);
        ListNode cur = dummyHead;
        while (l1 != null && l2 != null) {
            if (l1.val < l2.val) {
                cur.next = l1;
                l1 = l1.next;
            } else {
                cur.next = l2;
                l2 = l2.next;
            }
            cur = cur.next;
        }
        if (l1 == null) cur.next = l2;
        if (l2 == null) cur.next = l1;
        return dummyHead.next;
    }
}
