import java.util.ArrayList;
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
    public boolean isSameTree(TreeNode p, TreeNode q) {
        return dfs(p, q);
    }

    public boolean dfs(TreeNode root1, TreeNode root2) {
        if (root1 == null && root2 == null) return true;
        if (root1 == null || root2 == null || root1.val != root2.val) return false;
        return dfs(root1.left, root2.left) && dfs(root1.right, root2.right);
    }
}
