import java.util.ArrayList;
import java.util.List;
import java.util.Stack;

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
    public List<List<Integer>> zigzagLevelOrder(TreeNode root) {
        List<List<Integer>> result = new ArrayList<>();
        Stack<TreeNode> stack = new Stack<>();
        if (root != null) stack.push(root);

        boolean flag = true;
        TreeNode node;
        int size = stack.size();
        while (size != 0) {
            List<Integer> tempArray = new ArrayList<>();
            Stack<TreeNode> tempStack = new Stack<>();
            while (size-- > 0) {
                node = stack.pop();
                if (node == null) continue;
                tempArray.add(node.val);
                if (flag) {
                    tempStack.push(node.left);
                    tempStack.push(node.right);
                } else {
                    tempStack.push(node.right);
                    tempStack.push(node.left);
                }
            }
            flag = !flag;
            if (!tempArray.isEmpty()) result.add(tempArray);
            stack = tempStack;
            size = stack.size();
        }
        return result;
    }
}
