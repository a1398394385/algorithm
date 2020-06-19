import java.util.LinkedList;
import java.util.Queue;

class TreeNode
{
    int val;
    TreeNode left;
    TreeNode right;

    TreeNode(int x) {
        val = x;
    }
}


class Codec
{

    // Encodes a tree to a single string.
    public String serialize(TreeNode root) {
        if (root == null) return "";
        Queue<TreeNode> queue = new LinkedList<>();
        queue.add(root);
        StringBuilder result = new StringBuilder();
        while (queue.isEmpty() == false) {
            TreeNode node = queue.poll();
            if (node == null) {
                result.append(",null");
                continue;
            }
            result.append(",").append(node.val);
            queue.add(node.left);
            queue.add(node.right);
        }
        return result.toString().substring(1);
    }

    // Decodes your encoded data to tree.
    public TreeNode deserialize(String data) {
        if (data.equals("")) return null;
        String[] nodes = data.split(",");
        TreeNode root = new TreeNode(Integer.valueOf(nodes[0]));
        Queue<TreeNode> queue = new LinkedList<>();
        queue.add(root);
        for (int i = 1; i < nodes.length;) {
            TreeNode node = queue.poll();
            String temp;
            if ((temp = nodes[i++]).equals("null") == false) {
                TreeNode left = new TreeNode(Integer.valueOf(temp));
                node.left = left;
                queue.add(left);
            }
            if ((temp = nodes[i++]).equals("null") == false) {
                TreeNode right = new TreeNode(Integer.valueOf(temp));
                node.right = right;
                queue.add(right);
            }
        }
        return root;
    }
}


class Codec1
{

    // Encodes a tree to a single string.
    public String serialize(TreeNode root) {
        StringBuilder str = new StringBuilder();
        dfs1(root, str);
        return str.toString();
    }

    public void dfs1(TreeNode root, StringBuilder str) {
        if (root == null) { // 先序遍历，先处理根节点
            str.append("#,");
            return;
        }
        str.append(root.val).append(",");
        dfs1(root.left, str);// 再递归遍历左子树
        dfs1(root.right, str);
    }

    int index = 0;// 记录遍历到的string的下标
    // Decodes your encoded data to tree.

    public TreeNode deserialize(String data) {

        return dfs2(data);
    }

    public TreeNode dfs2(String data) {
        if (data.charAt(index) == '#') {
            index += 2;// 跳过‘#’，和‘，’
            return null;
        }
        boolean is_minus = false;
        if (data.charAt(index) == '-') {
            is_minus = true;
            index++;// 跳过减号
        }
        int t = 0;
        while (data.charAt(index) != ',') {
            t = t * 10 + data.charAt(index) - '0';
            index++;// 算好一个数的每位数
        }
        index++;// 跳过逗号
        if (is_minus) t = -t;
        TreeNode root = new TreeNode(t);
        root.left = dfs2(data);
        root.right = dfs2(data);
        return root;
    }
}
