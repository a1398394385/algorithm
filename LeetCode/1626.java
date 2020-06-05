import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

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
    // 3
    // / \
    // 9 20
    // / \
    // 15 7
    public List<List<Integer>> levelOrder(TreeNode root) {
        if (root == null) return new ArrayList<>();
        boolean direction = true;
        List<List<Integer>> result = new ArrayList<>();
        List<TreeNode> queue = new ArrayList<>();
        queue.add(root);
        while (queue.isEmpty() == false) {
            List<Integer> temp1 = new ArrayList<>();
            List<TreeNode> temp2 = new ArrayList<>();
            if (direction) {
                queue.forEach((node) -> {
                    temp1.add(node.val);
                    if (node.left != null) temp2.add(node.left);
                    if (node.right != null) temp2.add(node.right);
                });
            } else {
                queue.forEach((node) -> {
                    temp1.add(node.val);
                    if (node.right != null) temp2.add(node.right);
                    if (node.left != null) temp2.add(node.left);
                });
            }
            Collections.reverse(temp2);
            result.add(temp1);
            queue.clear();
            queue.addAll(temp2);
            direction = !direction;
        }
        return result;
    }

    public List<List<Integer>> result;

    public List<List<Integer>> levelOrder1(TreeNode root) {
        result = new ArrayList<>();
        bfs(root, 0);
        return result;
    }

    public void bfs(TreeNode root, int layers) {
        if (root == null) return;
        if (result.size() <= layers) result.add(new ArrayList<>());
        if ((layers & 1) == 1)
            result.get(layers).add(0, root.val);
        else
            result.get(layers).add(root.val);
        bfs(root.left, layers + 1);
        bfs(root.right, layers + 1);
    }
}
