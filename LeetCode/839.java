class Solution
{
    int[] pre;

    int find(int root) {
        if (pre[root] == root) return root;
        return pre[root] = find(pre[root]);
    }

    void merge(int x, int y) {
        pre[find(x)] = find(y);
    }

    boolean judge(int x, int y) {
        return find(x) == find(y);
    }

    void init(int n) {
        pre = new int[n];
        for (int i = 0; i < n; i++) pre[i] = i;
    }

    public int numSimilarGroups(String[] strs) {
        int length = strs.length;
        char[][] charsArr = new char[length][];
        pre = new int[length];
        for (int i = 0; i < length; i++) {
            charsArr[i] = strs[i].toCharArray();
            pre[i] = i;
        }

        for (int i = 0; i < length; i++) {
            for (int j = i + 1; j < length; j++) {
                if (!judge(i, j) && check(charsArr[i], charsArr[j])) {
                    merge(i, j);
                }
            }
        }
        int result = 0;
        for (int i = 0; i < length; i++)
            if (pre[i] == i) result++;
        return result;
    }

    boolean check(char[] a, char[] b) {
        int diff = 0;
        for (int i = 0, len = a.length; i < len; i++) {
            if (a[i] != b[i]) {
                if (++diff > 2) return false;
            }
        }
        return true;
    }
}
