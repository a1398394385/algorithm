
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
    TreeNode temp;

    public TreeNode convertBiNode(TreeNode root) {
        temp = new TreeNode(Integer.MIN_VALUE);
        TreeNode pre = temp;
        dfs(root);
        return pre.right;
    }

    public void dfs(TreeNode root) {
        if (root == null) return;
        dfs(root.left);
        temp = temp.right = root;
        root.left = null;
        dfs(root.right);
    }
}
