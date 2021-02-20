class Solution
{
    /**
     * 贪心
     */
    public int minSwapsCouples(int[] row) {
        int res = 0;
        for (int i = 0; i < row.length; i += 2) {
            int key = row[i];
            if (row[i + 1] == (key ^ 1)) continue;
            res++;
            for (int j = i + 1; j < row.length; j++) {
                if (row[j] == (key ^ 1)) {
                    row[j] = row[i + 1];
                    row[i + 1] = key ^ 1;
                    break;
                }
            }
        }
        return res;
    }

    /**
     * 贪心优化
     */
    public int minSwapsCouples1(int[] row) {
        int n = row.length;
        int ans = 0;
        int[] cache = new int[n];
        for (int i = 0; i < n; i++) cache[row[i]] = i;
        for (int i = 0; i < n - 1; i += 2) {
            int a = row[i], b = a ^ 1;
            if (row[i + 1] != b) {
                int src = i + 1, tar = cache[b];
                cache[row[tar]] = src;
                cache[row[src]] = tar;
                row[tar] = row[src];
                row[src] = a ^ 1;
                ans++;
            }
        }
        return ans;
    }

    /**
     * 并查集
     */
    int[] pre = new int[70];

    void merge(int a, int b) {
        pre[find(a)] = pre[find(b)];
    }

    int find(int root) {
        if (pre[root] == root) return root;
        return find(pre[root]);
    }

    public int minSwapsCouples2(int[] row) {
        int n = row.length, m = n / 2;
        for (int i = 0; i < m; i++) pre[i] = i;
        for (int i = 0; i < n; i += 2) merge(row[i] / 2, row[i + 1] / 2);
        int cnt = 0;
        for (int i = 0; i < m; i++) {
            if (i == find(i)) cnt++;
        }
        return m - cnt;
    }
}
