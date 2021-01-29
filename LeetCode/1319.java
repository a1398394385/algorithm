class Solution
{
    int[] pre;

    int find(int root) {
        if (root == pre[root]) return root;
        return pre[root] = find(pre[root]);
    }

    boolean merge(int x, int y) {
        if (judge(x, y)) return false;
        pre[find(x)] = find(y);
        return true;
    }

    boolean judge(int x, int y) {
        return find(x) == find(y);
    }

    void init(int n) {
        pre = new int[n];
        for (int i = 0; i < n; i++) pre[i] = i;
    }

    public int makeConnected(int n, int[][] connections) {
        init(n + 1);
        int result = n - 1, over = 0;
        for (int[] edge : connections) {
            if (merge(edge[0], edge[1]))
                result--;
            else
                over++;
        }
        return result <= over ? result : -1;
    }
}
