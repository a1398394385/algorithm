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
    boolean result;

    public boolean isBalanced(TreeNode root) {
        if (root == null) return true;
        result = true;
        dfs(root);
        return result;
    }

    public int dfs(TreeNode root) {
        if (root == null) return 0;
        int left = dfs(root.left);
        int right = dfs(root.right);
        if (Math.abs(left - right) > 1) result = false;
        return Math.max(left, right) + 1;
    }
}
