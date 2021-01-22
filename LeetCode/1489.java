import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

public class Solution
{
    int from, to;
    int[][] sortedMap;
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
        for (int i = 0; i < pre.length; i++) pre[i] = i;
    }

    int kruskal(int n, int init, boolean flag) {
        init(n);
        Set<Integer> VNew = new HashSet<>();
        if (flag) {
            VNew.add(from);
            VNew.add(to);
            merge(from, to);
        } else {
            VNew.add(0);
        }
        int result = init, num = VNew.size() - 1;
        int u, v;
        for (int i = 0; i < sortedMap.length && num < n - 1; i++) {
            u = sortedMap[i][0];
            v = sortedMap[i][1];
            if ((u == from && v == to) || judge(u, v)) continue;
            result += sortedMap[i][2];
            VNew.add(u);
            VNew.add(v);
            merge(u, v);
            num++;
        }
        if (num != n - 1) return Integer.MAX_VALUE;
        return result;
    }

    public List<List<Integer>> findCriticalAndPseudoCriticalEdges(int n, int[][] edges) {
        pre = new int[n];
        sortedMap = new int[edges.length][3];
        for (int i = 0; i < edges.length; i++) System.arraycopy(edges[i], 0, sortedMap[i], 0, 3);
        Arrays.sort(sortedMap, (a, b) -> a[2] - b[2]);

        int MIN = kruskal(n, 0, false);
        List<Integer> essential = new ArrayList<>(), nonEssential = new ArrayList<>();
        int min = 0;
        for (int i = 0; i < edges.length; i++) {
            from = edges[i][0];
            to = edges[i][1];
            min = kruskal(n, 0, false);
            if (min != MIN) {
                essential.add(i);
            } else {
                min = kruskal(n, edges[i][2], true);
                if (min == MIN) nonEssential.add(i);
            }
            from = to = 0;
        }
        return Arrays.asList(essential, nonEssential);
    }
}


class Solution1
{
    static final int MAX = 10010;

    class Edge
    {
        int to, next, weight;

        Edge() {
            to = next = weight = 0;
        }
    }

    Edge[] map = new Edge[MAX];
    int[] head = new int[MAX];
    int cnt = 0;

    void add(int u, int v, int w) {
        map[++cnt] = new Edge();
        map[cnt].to = v;
        map[cnt].weight = w;
        map[cnt].next = head[u];
        head[u] = cnt;
    }

    boolean[] flag = new boolean[MAX];
    List<Integer> VNew = new ArrayList<>();

    int prim(int n, int init) {
        int[] list = new int[n];
        int result = init;
        boolean[] came = new boolean[n];
        for (Integer u : VNew) {
            came[u] = true;
        }
        int min = Integer.MAX_VALUE, index = 0;
        while (VNew.size() < n) {
            for (Integer u : VNew) {
                for (int i = head[u]; i != 0; i = map[i].next) {
                    if (came[map[i].to] || flag[i]) continue;
                    if (map[i].weight < min) {
                        min = map[i].weight;
                        index = map[i].to;
                        list[VNew.size()] = i;
                    }
                }
            }
            if (min == Integer.MAX_VALUE) break;
            result += min;
            min = Integer.MAX_VALUE;
            VNew.add(index);
            came[index] = true;
        }
        return result;
    }


    int MIN = Integer.MAX_VALUE;

    public List<List<Integer>> findCriticalAndPseudoCriticalEdges(int n, int[][] edges) {
        for (int i = 0; i < edges.length; i++) {
            add(edges[i][0], edges[i][1], edges[i][2]);
            add(edges[i][1], edges[i][0], edges[i][2]);
        }
        VNew.clear();
        VNew.add(0);
        MIN = prim(n, 0);
        List<Integer> essential = new ArrayList<>(), nonEssential = new ArrayList<>();
        int min = 0;
        for (int i = 0; i < edges.length; i++) {
            int a = (i + 1) << 1, b = a - 1;
            flag[a] = flag[b] = true;
            VNew.clear();
            VNew.add(0);
            min = prim(n, 0);
            if (min != MIN) {
                essential.add(i);
            } else {
                VNew.clear();
                VNew.add(edges[i][0]);
                VNew.add(edges[i][1]);
                min = prim(n, edges[i][2]);
                if (min == MIN) nonEssential.add(i);
            }
            flag[a] = flag[b] = false;
        }
        return Arrays.asList(essential, nonEssential);
    }
}
