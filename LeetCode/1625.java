import java.util.ArrayDeque;
import java.util.ArrayList;
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


class Solution
{
    public List<List<Integer>> result;

    public List<List<Integer>> levelOrder(TreeNode root) {
        result = new ArrayList<>();
        dfs(root, 0);
        return result;
    }

    public void dfs(TreeNode root, int deep) {
        if (root == null) return;
        if (deep >= result.size()) result.add(new ArrayList<>());
        result.get(deep).add(root.val);
        dfs(root.left, deep + 1);
        dfs(root.right, deep + 1);
    }

    public List<List<Integer>> levelOrder1(TreeNode root) {
        if (root == null) return new ArrayList<>();
        int deep = 0;
        List<List<Integer>> result = new ArrayList<>();
        Queue<TreeNode> queue = new ArrayDeque<>();
        queue.add(root);
        while (queue.isEmpty() == false) {
            result.add(new ArrayList<>());
            int size = queue.size();
            while (size-- > 0) {
                TreeNode node = queue.poll();
                result.get(deep).add(node.val);
                if (node.left != null) queue.add(node.left);
                if (node.right != null) queue.add(node.right);
            }
            deep++;
        }
        return result;
    }
}
