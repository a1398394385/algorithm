import java.util.ArrayDeque;
import java.util.List;
import java.util.Queue;

class Node
{
    public int val;
    public List<Node> children;

    public Node() {}

    public Node(int _val) {
        val = _val;
    }

    public Node(int _val, List<Node> _children) {
        val = _val;
        children = _children;
    }
};


class Solution
{
    public int maxDepth(Node root) {
        if (root == null) return 0;
        int deep = 0;
        Queue<Node> queue = new ArrayDeque<>();
        queue.add(root);
        while (queue.isEmpty() == false) {
            deep++;
            int size = queue.size();
            while (size-- > 0) {
                Node node = queue.poll();
                queue.addAll(node.children);
            }
        }
        return deep;
    }

    public int maxDepth1(Node root) {
        if (root == null) { return 0; }
        int deep = 1;
        for (Node node : root.children) {
            deep = Math.max(deep, maxDepth1(node) + 1);
        }
        return deep;
    }
}
