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
    public boolean isSubtree(TreeNode s, TreeNode t) {
        if (s == null) return false;
        if (t == null) return true;
        if (s.val == t.val && isEuqal(s.left, t.left) && isEuqal(s.right, t.right))
            return true;
        return isSubtree(s.left, t) || isSubtree(s.right, t);
    }

    public boolean isEuqal(TreeNode s, TreeNode t) {
        if (s == t) return true;
        if (s == null || t == null || s.val != t.val) return false;
        return isEuqal(s.left, t.left) && isEuqal(s.right, t.right);
    }

    public static void main(String[] args) {
        TreeNode s = null;
        TreeNode t = null;
        System.out.println(s == t);
    }
}
