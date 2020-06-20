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
    private int result = Integer.MIN_VALUE;

    public int maxPathSum(TreeNode root) {
        findMax(root);
        return this.result;
    }

    public int findMax(TreeNode root) {
        if (root == null) return 0;
        int left = Math.max(0, findMax(root.left));
        int right = Math.max(0, findMax(root.right));
        this.result = Math.max(this.result, left + right + root.val);
        return Math.max(left, right) + root.val;
    }
}
