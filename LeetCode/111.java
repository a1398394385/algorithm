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
    public int minDepth(TreeNode root) {
        if (root == null) return 0;
        if (root.left == null && root.right == null) return 1;
        int deep = 1;
        if (root.left == null) return deep += minDepth(root.right);
        if (root.right == null) return deep += minDepth(root.left);
        return deep += Math.min(minDepth(root.left), minDepth(root.right));
    }
}
