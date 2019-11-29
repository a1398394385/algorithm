public class Solution {

    public  static TreeNode reConstructBinaryTree(int [] prev,int [] in) {
	//不管什么遍历方式，结果长度肯定是一样的，都是总结点数
        if(prev.length!= in.length || prev.length<1){
            return null;
        }
	//只有一个节点，那就是根节点
        if(prev.length == 1){
            return new TreeNode(prev[0]);
        }
	//在中序遍历结果中找根节点
        int index = -1;
        for(int i=0;i<in.length;i++){
            if(in[i]==prev[0]){
                index=i;
                break;
            }
        }
	//没找到，说明数据有问题
        if(index==-1){
            return null;
        }
	//找到根节点了
        TreeNode root = new TreeNode(prev[0]);
	//得到左子树的前序遍历结果
        int[] lChildPrev = new int[index];
        System.arraycopy(prev,1,lChildPrev,0,index);
	//得到左子树的中序遍历结果
        int[] lChildin = new int[index];
        System.arraycopy(in,0,lChildin,0,index);
	//通过递归，得到左子树结构
        root.left=reConstructBinaryTree(lChildPrev,lChildin);

	//得到右子树的前序遍历结果
        int[] rChildPrev = new int[in.length-1-index];
        System.arraycopy(prev,index+1,rChildPrev,0,in.length-1-index);
	//得到右子树的中序遍历结果
        int[] rChildin = new int[in.length-1-index];
        System.arraycopy(in,index+1,rChildin,0,in.length-1-index);
	//通过递归，得到右子树结构
        root.right=reConstructBinaryTree(rChildPrev,rChildin);
	//得到完整的二叉树结构
        return root;
    }

    //测试
//     public static void main(String[] args){
// 	int[] prev = {1,2,4,7,3,5,6,8};
// 	int[] in = {4,7,2,1,5,3,8,6};
// 	TreeNode root = reConstructBinaryTree(prev,in);
// 	prevPrintTreeNode(root);
// 	System.out.println();
// 	inPrintTreeNode(root);
//     }
//测试结果
//1 2 4 7 3 5 6 8
//4 7 2 1 5 3 8 6
}

public class Solution {
    public TreeNode reConstructBinaryTree(int [] pre,int [] in) {
        TreeNode root=reConstructBinaryTree(pre,0,pre.length-1,in,0,in.length-1);
        return root;
    }
    //前序遍历{1,2,4,7,3,5,6,8}和中序遍历序列{4,7,2,1,5,3,8,6}

    /**
    * 反推二叉树
    *
    * @param array $pre    前序遍历
    * @param int $startPre 前序头索引
    * @param int $endPre   前序尾索引
    * @param array $in     中序遍历
    * @param int $startIn  中序头索引
    * @param int $endIn    中序尾索引
    */
    private TreeNode reConstructBinaryTree(int [] pre,int startPre,int endPre,int [] in,int startIn,int endIn) {

        if(startPre > endPre || startIn > endIn)
            return null;

        TreeNode root = new TreeNode(pre[startPre]);

        前序遍历序列 {1,2,4,7,3,5,6,8}
        中序遍历序列 {4,7,2,1,5,3,8,6}

        for(int i = startIn; i <= endIn; i++)
            if (in[i] == pre[startPre]) {
                root.left = reConstructBinaryTree(pre,startPre+1,startPre+i-startIn,in,startIn,i-1);
                root.right = reConstructBinaryTree(pre,i-startIn+startPre+1,endPre,in,i+1,endIn);
                break;
            }

        return root;
    }
}
