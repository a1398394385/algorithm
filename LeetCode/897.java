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
    public TreeNode tree, curr;

    public TreeNode increasingBST(TreeNode root) {
        inOrder(root);
        return tree;
    }

    public void inOrder(TreeNode root) {
        if (root == null) return;
        inOrder(root.left);
        root.left = null;
        if (tree == null)
            curr = tree = root;
        else
            curr = curr.right = root;
        inOrder(root.right);
    }
}
