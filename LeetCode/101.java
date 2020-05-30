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
    public boolean isSymmetric(TreeNode root) {
        if (root == null) return true;
        return bfs(root.left, root.right);
    }

    public boolean bfs(TreeNode left, TreeNode right) {
        if (left == null && right == null)
            return true;
        else if (left == null || right == null)
            return false;
        if (left.val != right.val) return false;
        return bfs(left.left, right.right) && bfs(left.right, right.left);
    }
}
