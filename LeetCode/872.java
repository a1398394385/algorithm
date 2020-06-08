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
    public boolean leafSimilar(TreeNode root1, TreeNode root2) {
        if (root1 == null && root2 == null) return true;
        if (root1 == null || root2 == null) return false;
        List<Integer> leaf1 = new ArrayList<>(), leaf2 = new ArrayList<>();
        dfs(root1, leaf1);
        dfs(root2, leaf2);
        int len1 = leaf1.size(), len2 = leaf2.size();
        if (len1 != len2) return false;
        for (int i = 0; i < len1; i++)
            if (leaf1.get(i) != leaf2.get(i))
                return false;
        return true;
    }

    public void dfs(TreeNode root, List<Integer> leaf) {
        if (root == null) return;
        if (root.left == null && root.right == null) leaf.add(root.val);
        dfs(root.left, leaf);
        dfs(root.right, leaf);
    }
}
