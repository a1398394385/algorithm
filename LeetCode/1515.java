import java.util.ArrayList;
import java.util.LinkedList;
import java.util.List;
import java.util.Queue;

class TreeNode
{
    int val;
    TreeNode left;
    TreeNode right;

    TreeNode(int x) {
        val = x;
    }
}


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
    public List<ListNode> list;

    public ListNode[] listOfDepth(TreeNode tree) {
        if (tree == null) return new ListNode[0];
        list = new ArrayList<>();
        dfs(tree, 0);
        return list.toArray(new ListNode[0]);
    }

    public void dfs(TreeNode root, int deep) {
        if (root == null) return;
        if (deep >= list.size()) {
            list.add(new ListNode(root.val));
        } else {
            ListNode node = list.get(deep);
            while (node.next != null) node = node.next;
            node.next = new ListNode(root.val);
        }
        dfs(root.left, deep + 1);
        dfs(root.right, deep + 1);
    }

    public ListNode[] listOfDepth1(TreeNode tree) {
        if (tree == null) return new ListNode[0];

        int deep = 0;
        List<ListNode> list = new ArrayList<>();
        Queue<TreeNode> queue = new LinkedList<>();
        queue.add(tree);
        while (queue.isEmpty() == false) {
            int size = queue.size();
            while (size-- > 0) {
                TreeNode root = queue.poll();
                if (deep >= list.size()) {
                    list.add(new ListNode(root.val));
                } else {
                    ListNode node = list.get(deep);
                    while (node.next != null) node = node.next;
                    node.next = new ListNode(root.val);
                }
                if (root.left != null) queue.add(root.left);
                if (root.right != null) queue.add(root.right);
            }
            deep++;
        }

        return list.toArray(new ListNode[0]);
    }
}


class Solution1
{
    public ListNode[] result;

    public ListNode[] listOfDepth(TreeNode tree) {
        result = new ListNode[depth(tree)];
        dfs(tree, 0);
        return result;
    }

    public int depth(TreeNode root) {
        return (root == null) ? 0 : Math.max(depth(root.left), depth(root.right)) + 1;
    }

    public void dfs(TreeNode root, int deep) {
        if (root == null) return;

        if (result[deep] == null) {
            result[deep] = new ListNode(root.val);
        } else {
            ListNode node = new ListNode(root.val);
            node.next = result[deep];
            result[deep] = node;
        }

        dfs(root.right, deep + 1);
        dfs(root.left, deep + 1);
    }
}
