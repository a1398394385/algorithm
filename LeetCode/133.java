import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Queue;

class Node
{
    public int val;
    public List<Node> neighbors;

    public Node() {
        val = 0;
        neighbors = new ArrayList<Node>();
    }

    public Node(int _val) {
        val = _val;
        neighbors = new ArrayList<Node>();
    }

    public Node(int _val, ArrayList<Node> _neighbors) {
        val = _val;
        neighbors = _neighbors;
    }
}


class Solution
{
    static final Map<Node, Node> map = new HashMap<>();

    public Node cloneGraph(Node root) {
        if (root == null) return null;
        Queue<Node> queue = new LinkedList<>();
        queue.add(root);
        while (queue.isEmpty() == false) {
            Node temp = queue.poll();
            map.put(temp, new Node(temp.val));
            temp.neighbors.forEach((node) -> {
                if (map.containsKey(node) == false) {
                    queue.add(node);
                }
            });
        }
        map.forEach((key, value) -> {
            key.neighbors.forEach((node) -> {
                value.neighbors.add(map.get(node));
            });
        });
        return map.get(root);
    }


    public HashMap<Integer, Node> set = new HashMap<>();

    public Node cloneGraph1(Node node) {
        if (node == null) return null;

        if (set.containsKey(node.val)) return set.get(node.val);

        Node copy = new Node(node.val, new ArrayList<Node>());
        set.put(copy.val, copy);

        for (Node temp : node.neighbors) {
            copy.neighbors.add(cloneGraph1(temp));
        }
        return copy;
    }
}

