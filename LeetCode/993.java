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
    public TreeNode X, Y;
    public int deepX, deepY;

    public boolean isCousins(TreeNode root, int x, int y) {
        dfs(root, null, 0, x, y);
        return (X != Y && deepX == deepY);
    }

    public void dfs(TreeNode root, TreeNode father, int deep, int x, int y) {
        if (root == null) return;
        if (root.val == x) {
            X = father;
            deepX = deep;
            return;
        }
        if (root.val == y) {
            Y = father;
            deepY = deep;
            return;
        }
        dfs(root.left, root, deep + 1, x, y);
        dfs(root.right, root, deep + 1, x, y);
    }
}
