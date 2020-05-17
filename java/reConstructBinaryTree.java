package java;

class TreeNode
{
    public TreeNode left;
    public TreeNode right;
    public int value;

    public TreeNode(int value) {
        this.value = value;
    }
}


public class reConstructBinaryTree
{



    public static TreeNode reConstructBinaryTree(int[] prev, int[] in) {
        if (prev.length != in.length || prev.length < 1) { return null; }
        if (prev.length == 1) { return new TreeNode(prev[0]); }

        // 在中序遍历结果中找根节点
        int index = -1;
        for (int i = 0; i < in.length; i++) {
            if (in[i] == prev[0]) {
                index = i;
                break;
            }
        }
        // 没找到，说明数据有问题
        if (index == -1) { return null; }

        TreeNode root = new TreeNode(prev[0]);

        int[] lChildPrev = new int[index];
        System.arraycopy(prev, 1, lChildPrev, 0, index);
        int[] lChildin = new int[index];
        System.arraycopy(in, 0, lChildin, 0, index);
        root.left = reConstructBinaryTree(lChildPrev, lChildin);

        int[] rChildPrev = new int[in.length - 1 - index];
        System.arraycopy(prev, index + 1, rChildPrev, 0, in.length - 1 - index);
        int[] rChildin = new int[in.length - 1 - index];
        System.arraycopy(in, index + 1, rChildin, 0, in.length - 1 - index);
        root.right = reConstructBinaryTree(rChildPrev, rChildin);

        return root;
    }

    public TreeNode reConstructBinaryTree1(int[] pre, int[] in) {
        return reConstructBinaryTree(pre, 0, pre.length - 1, in, 0, in.length - 1);
    }

    /**
     * 反推二叉树
     *
     * @param pre 前序遍历
     * @param startPre 前序头索引
     * @param endPre 前序尾索引
     * @param in 中序遍历
     * @param startIn 中序头索引
     * @param endIn 中序尾索引
     */
    private static TreeNode reConstructBinaryTree(int[] pre, int startPre, int endPre, int[] in, int startIn,
            int endIn) {

        if (startPre > endPre || startIn > endIn) return null;

        TreeNode root = new TreeNode(pre[startPre]);

        for (int i = startIn; i <= endIn; i++)
            if (in[i] == pre[startPre]) {
                root.left = reConstructBinaryTree(pre, startPre + 1, startPre + i - startIn, in, startIn, i - 1);
                root.right = reConstructBinaryTree(pre, i - startIn + startPre + 1, endPre, in, i + 1, endIn);
                break;
            }

        return root;
    }

    public static void main(String[] args) {
        int[] prev = {1, 2, 4, 7, 3, 5, 6, 8};
        int[] in = {4, 7, 2, 1, 5, 3, 8, 6};
        TreeNode root = reConstructBinaryTree(prev, in);
        // prevPrintTreeNode(root);
        // 1 2 4 7 3 5 6 8
        System.out.println();
        // inPrintTreeNode(root);
        // 4 7 2 1 5 3 8 6
    }


}
