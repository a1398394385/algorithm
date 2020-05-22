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
    public TreeNode buildTree(int[] preOrder, int[] inOrder) {
        if (preOrder.length != inOrder.length || preOrder.length < 1) { return null; }
        if (preOrder.length == 1) { return new TreeNode(preOrder[0]); }

        // 在中序遍历结果中找根节点
        int index = -1;
        for (int i = 0; i < inOrder.length; i++) {
            if (inOrder[i] == preOrder[0]) {
                index = i;
                break;
            }
        }
        // 没找到，说明数据有问题
        if (index == -1) { return null; }

        TreeNode root = new TreeNode(preOrder[0]);

        int[] lChildPreOrder = new int[index];
        System.arraycopy(preOrder, 1, lChildPreOrder, 0, index);
        int[] lChildInOrder = new int[index];
        System.arraycopy(inOrder, 0, lChildInOrder, 0, index);
        root.left = buildTree(lChildPreOrder, lChildInOrder);

        int[] rChildPreOrder = new int[inOrder.length - 1 - index];
        System.arraycopy(preOrder, index + 1, rChildPreOrder, 0, inOrder.length - 1 - index);
        int[] rChildInOrder = new int[inOrder.length - 1 - index];
        System.arraycopy(inOrder, index + 1, rChildInOrder, 0, inOrder.length - 1 - index);
        root.right = buildTree(rChildPreOrder, rChildInOrder);

        return root;
    }

    public TreeNode buildTree1(int[] pre, int[] in) {
        return reConstructBinaryTree(pre, 0, pre.length - 1, in, 0, in.length - 1);
    }

    private TreeNode reConstructBinaryTree(int[] pre, int startPre, int endPre, int[] in, int startIn, int endIn) {
        if (startPre > endPre || startIn > endIn) return null;

        TreeNode root = new TreeNode(pre[startPre]);
        for (int i = startIn; i <= endIn; i++) {
            if (in[i] == pre[startPre]) {
                root.left = reConstructBinaryTree(pre, startPre + 1, startPre + i - startIn, in, startIn, i - 1);
                root.right = reConstructBinaryTree(pre, i - startIn + startPre + 1, endPre, in, i + 1, endIn);
                break;
            }
        }
        return root;
    }
}
