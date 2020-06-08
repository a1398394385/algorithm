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
    public List<String> binaryTreePaths(TreeNode root) {
        List<String> result = new ArrayList<>();
        dfs(root, new StringBuilder(), result);
        return result;
    }

    public void dfs(TreeNode root, String path, List<String> result) {
        if (root == null) return;
        path += root.val;
        if (root.left == null && root.right == null) result.add(path);
        dfs(root.left, path + "->", result);
        dfs(root.right, path + "->", result);
    }

    public void dfs(TreeNode root, StringBuilder path, List<String> result) {
        if (root == null) return;
        path.append(root.val);
        if (root.left == null && root.right == null) result.add(path.toString());
        path.append("->");
        int length = path.length();
        dfs(root.left, path, result);
        path.delete(length, path.length());
        dfs(root.right, path, result);
    }
}
