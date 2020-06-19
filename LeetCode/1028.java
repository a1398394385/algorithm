import java.util.Stack;

class Solution
{
    public TreeNode recoverFromPreorder(String S) {
        if (S.length() == 0) return null;
        Stack<TreeNode> stack = new Stack<>();
        char[] chars = S.toCharArray();
        int index = 0, length = chars.length, num = 0;
        while (index < length && '0' <= chars[index] && chars[index] <= '9')
            num = num * 10 + chars[index++] - '0';
        TreeNode root = new TreeNode(num);
        stack.push(root);
        while (stack.isEmpty() == false && index < chars.length) {
            int deep = 0;
            while (index < length && chars[index] == '-') {
                deep++;
                index++;
            }
            while (deep < stack.size()) stack.pop();
            num = 0;
            while (index < length && '0' <= chars[index] && chars[index] <= '9')
                num = num * 10 + chars[index++] - '0';
            TreeNode node = new TreeNode(num);
            if (stack.peek().left == null)
                stack.peek().left = node;
            else
                stack.peek().right = node;
            stack.push(node);
        }
        return root;
    }

    public TreeNode recoverFromPreorder1(String S) {
        return dfs(S.toCharArray(), new int[] {0}, 0);
    }

    private TreeNode dfs(char[] chs, int[] i, int level) {
        if (i[0] == chs.length) { return null; }
        int c = 0;
        int j = i[0];
        while (chs[j] == '-') {
            j++;
            c++;
        }
        if (c != level) { return null; }
        int num = 0;
        while (j < chs.length && chs[j] != '-') {
            num = num * 10 + (chs[j] - '0');
            j++;
        }
        TreeNode root = new TreeNode(num);
        i[0] = j;
        root.left = dfs(chs, i, level + 1);
        root.right = dfs(chs, i, level + 1);
        return root;
    }
}
