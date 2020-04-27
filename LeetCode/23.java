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

// 1->4->5,
// 1->3->4,
// 2->6
class Solution
{
    public ListNode mergeKLists(ListNode[] lists) {
        if (lists.length == 0 || !(lists[0] instanceof ListNode)) return null;
        Queue<Integer> queue = new PriorityQueue<>((Integer newValue, Integer oldValue)-> {
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

    public static void main(String[] args) {
        ListNode list1 = new ListNode(1);
        list1.next = new ListNode(4);
        list1.next.next = new ListNode(5);
        ListNode list2 = new ListNode(1);
        list2.next = new ListNode(3);
        list2.next.next = new ListNode(4);
        ListNode list3 = new ListNode(2);
        list3.next = new ListNode(6);
        Solution test = new Solution();
        ListNode root = test.mergeKLists(new ListNode[] { list1, list2, list3 });

        while (root != null) {
            System.out.println(root.val);
            root = root.next;
        }
    }
}
