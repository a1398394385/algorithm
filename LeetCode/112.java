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
    public boolean hasPathSum(TreeNode root, int sum) {
        return dfs(root, 0, sum);
    }

    public boolean dfs(TreeNode root, int temp, int sum) {
        if (root == null) return false;
        if (root.left == null && root.right == null) return temp + root.val == sum;
        return dfs(root.left, temp + root.val, sum) | dfs(root.right, temp + root.val, sum);
    }

    public boolean hasPathSum1(TreeNode root, int sum) {
        if (root == null) return false;
        if (root.left == null && root.right == null) return sum == root.val;
        return hasPathSum1(root.left, sum - root.val) | hasPathSum1(root.right, sum - root.val);
    }
}
