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
    public TreeNode lowestCommonAncestor(TreeNode root, TreeNode p, TreeNode q) {
        if (p.val == root.val || q.val == root.val) return root;
        if (p.val > root.val && q.val > root.val) return lowestCommonAncestor(root.right, p, q);
        if (p.val < root.val && q.val < root.val) return lowestCommonAncestor(root.left, p, q);
        return root;
    }

    public TreeNode lowestCommonAncestor1(TreeNode root, TreeNode p, TreeNode q) {
        TreeNode min, max;
        if (p.val < q.val) {
            min = p;
            max = q;
        } else {
            min = q;
            max = p;
        }
        return recursion(root, min, max);
    }

    public TreeNode recursion(TreeNode current, TreeNode min, TreeNode max) {
        if (current.val == min.val || current.val == max.val || (current.val < max.val && current.val > min.val))
            return current;
        if (current.val > max.val)
            return recursion(current.left, min, max);
        else
            return recursion(current.right, min, max);
    }
}
