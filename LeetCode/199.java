/**
 * Definition for a binary tree node. public class TreeNode { int val; TreeNode
 * left; TreeNode right; TreeNode(int x) { val = x; } }
 */

class Solution {
    public List<Integer> rightSideView(TreeNode root) {
        List<Integer> result = new ArrayList<>();
        if (root != null) {
            Queue<TreeNode> queue = new LinkedList<>();
            queue.offer(root);
            while (queue.size() != 0) {
                result.add(queue.peek().val);
                int size = queue.size();
                while (size-- != 0) {
                    TreeNode temp = queue.poll();
                    if (temp.right != null)
                        queue.offer(temp.right);
                    if (temp.left != null)
                        queue.offer(temp.left);
                }
            }
        }
        return result;
    }
}