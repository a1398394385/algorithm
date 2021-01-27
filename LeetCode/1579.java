class Solution
{
    static class UnionFind
    {
        private int[] pre;
        public int num;

        public UnionFind(int n) {
            num = n - 1;
            pre = new int[n + 1];
            for (int i = 0; i < n; i++) pre[i] = i;
        }

        public int find(int root) {
            if (root == pre[root]) return root;
            return pre[root] = find(pre[root]);
        }

        public boolean merge(int x, int y) {
            if (judge(x, y)) return false;
            pre[find(x)] = find(y);
            num--;
            return true;
        }

        public boolean judge(int x, int y) {
            return find(x) == find(y);
        }
    }

    public int maxNumEdgesToRemove(int n, int[][] edges) {
        UnionFind preA = new UnionFind(n), preB = new UnionFind(n);
        int result = 0;
        for (int[] edge : edges) {
            int type = edge[0], u = edge[1], v = edge[2];
            if (type == 3) {
                boolean tempA = preA.merge(u, v), tempB = preB.merge(u, v);
                if (!tempA && !tempB) result += 1;
            }
        }
        for (int[] edge : edges) {
            int type = edge[0], u = edge[1], v = edge[2];
            if (type == 1 && !preA.merge(u, v)) result += 1;
            if (type == 2 && !preB.merge(u, v)) result += 1;
        }
        if (preA.num != 0 || preB.num != 0) return -1;
        return result;
    }
}
