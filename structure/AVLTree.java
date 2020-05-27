import java.util.ArrayList;
import java.util.List;

/**
 * AVLTree
 */
public class AVLTree
{
    final static int LH = 1; // 左子树高（高度差）
    final static int EH = 0; // 等高
    final static int RH = -1; // 右子树高（高度差）

    static class AVLNode
    {
        public int data;
        public int bf = EH; // 平衡因子BF
        public AVLNode left = null;
        public AVLNode right = null;
        public AVLNode father = null;

        public AVLNode(int data, AVLNode father) {
            this.data = data;
            this.father = father;
        }

        @Override
        public String toString() {
            List<String> list = new ArrayList<>();
            String bfString;
            if (bf == EH)
                bfString = "EH";
            else if (bf == LH)
                bfString = "LH";
            else
                bfString = "RH";
            if (left != null) list.add(left.toString());
            list.add("AVLNode:" + data +
                    " [bf = " + bfString
                    + ", father = " + (father == null ? "null" : father.data)
                    + ", left = " + (left == null ? "null" : left.data)
                    + ", right = " + (right == null ? "null" : right.data)
                    + "]");
            if (right != null) list.add(right.toString());
            return String.join("\r\n", list);
        }
    }

    private AVLNode root;

    public AVLNode getRoot() {
        return root;
    }

    public AVLNode getTree() {
        return root;
    }

    public void insert(int data) {
        if (root == null)
            root = new AVLNode(data, null);
        else {
            if (data > root.data)
                insertRightNode(data, root);
            if (data < root.data)
                insertLeftNode(data, root);
        }
    }

    protected boolean insertRightNode(int data, AVLNode father) {
        if (data == father.data) return false;
        if (data > father.data) {
            if (father.right == null) {
                father.right = new AVLNode(data, father);
                return (father.bf += RH) == RH;
            }
            if (insertRightNode(data, father.right)) {
                if (father.bf == RH)
                    balancedRightSubtree(father);
                else
                    return (father.bf += RH) == RH;
            }
            return false;
        }
        return insertLeftNode(data, father);
    }

    protected boolean insertLeftNode(int data, AVLNode father) {
        if (data == father.data) return false;
        if (data < father.data) {
            if (father.left == null) {
                father.left = new AVLNode(data, father);
                return (father.bf += LH) == LH;
            }
            if (insertLeftNode(data, father.left)) {
                if (father.bf == LH)
                    balancedLeftSubtree(father);
                else
                    return (father.bf += LH) == LH;
            }
            return false;
        }
        return insertRightNode(data, father);
    }


    protected void balancedRightSubtree(AVLNode tree) {
        AVLNode child = tree.right;
        if (child.bf == RH) {
            tree.bf = child.bf = EH;
            leftRotate(tree);
        }
        if (child.bf == LH) {
            switch (child.left.bf) {
                case LH:
                    tree.bf = EH;
                    child.bf = RH;
                    break;
                case EH:
                    tree.bf = child.bf = EH;
                    break;
                case RH:
                    tree.bf = LH;
                    child.bf = EH;
                    break;
            }
            child.left.bf = EH;
            rightRotate(tree.right);
            leftRotate(tree);
        }
    }

    protected void balancedLeftSubtree(AVLNode tree) {
        AVLNode child = tree.left;
        // The newly inserted node is the left child of the left subtree, rotate to the right
        if (child.bf == LH) {
            tree.bf = child.bf = EH;
            rightRotate(tree);
        }
        // The newly inserted node is the right child of the left subtree, rotate to the left and then rotate to
        // the right
        if (child.bf == RH) {
            switch (child.right.bf) {
                case LH:
                    tree.bf = RH;
                    child.bf = EH;
                    break;
                case EH:
                    tree.bf = child.bf = EH;
                    break;
                case RH:
                    tree.bf = EH;
                    child.bf = LH;
                    break;
            }
            child.right.bf = EH;
            leftRotate(tree.left);
            rightRotate(tree);
        }
    }

    protected void rightRotate(AVLNode oldRoot) {
        // Make the left child of the old root the new root
        AVLNode newRoot = oldRoot.left;
        // Whether the old root is the left child
        boolean isLeft = false;
        newRoot.father = null;
        if (oldRoot.father != null) {
            newRoot.father = oldRoot.father;
            if (oldRoot == oldRoot.father.left)
                isLeft = true;
        }
        // Hang the right subtree of the original left node to the left subtree of the old root
        oldRoot.left = newRoot.right;
        // Use the old root as the right subtree of the new root
        oldRoot.father = newRoot;
        newRoot.right = oldRoot;
        if (newRoot.father != null) {
            if (isLeft)
                newRoot.father.left = newRoot;
            else
                newRoot.father.right = newRoot;
        } else {
            // The old root is the tree root
            this.root = newRoot;
        }
    }

    protected void leftRotate(AVLNode oldRoot) {
        // The logic is the opposite of rightRotate
        AVLNode newRoot = oldRoot.right;
        boolean isRight = false;
        newRoot.father = null;
        if (oldRoot.father != null) {
            newRoot.father = oldRoot.father;
            if (oldRoot == oldRoot.father.right)
                isRight = true;
        }
        oldRoot.right = newRoot.left;
        oldRoot.father = newRoot;
        newRoot.left = oldRoot;
        if (newRoot.father != null) {
            if (isRight)
                newRoot.father.right = newRoot;
            else
                newRoot.father.left = newRoot;
        } else {
            this.root = newRoot;
        }
    }

    public static void main(String[] args) {
        // AVLTree tree = new AVLTree();
        // tree.insert(6);
        // tree.insert(3);
        // tree.insert(7);
        // tree.insert(2);
        // tree.insert(5);
        // PrintTree.printTreeToImage(tree.root);
        // tree.insert(4);
        // PrintTree.printTreeToImage(tree.root);
        // System.out.println(tree.root);
        // tree.insert(2);
        // tree.insert(1);
        // tree.insert(5);
        // tree.insert(3);
        // tree.insert(6);
        // PrintTree.printTreeToImage(tree.root);
        // tree.insert(4);
        // PrintTree.printTreeToImage(tree.root);
        // System.out.println(tree.root);
    }

    static class PrintTree
    {
        public static void printTreeToImage(AVLNode root) {
            printInOrder(root, 0, "H", 8);
            System.out.println("\r\n\r\n");
        }

        public static void printInOrder(AVLNode root, int height, String flag, int len) {
            if (root == null) { return; }
            printInOrder(root.right, height + 1, "R", len);
            String val = height + flag + ": " + root.data;
            int lenM = val.length();
            int lenL = (len - lenM) / 2;
            int lenR = len - lenM - lenL;
            val = getSpace(lenL) + val + getSpace(lenR);
            System.out.println(getSpace(height * len) + val);
            printInOrder(root.left, height + 1, "L", len);
        }

        public static String getSpace(int num) {
            StringBuffer buf = new StringBuffer("");
            for (int i = 0; i < num; i++)
                buf.append(" ");
            return buf.toString();
        }
    }
}
