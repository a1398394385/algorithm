import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

public class Solution
{
    public HashMap<Integer, List<Integer>> map;
    public int[] colors;

    public boolean possibleBipartition(int N, int[][] dislikes) {
        if (dislikes == null || dislikes.length == 0) return true;
        map = new HashMap<>();
        colors = new int[N + 1];
        for (int i = 1; i <= N; i++) map.put(i, new ArrayList<>());
        for (int[] dislike : dislikes) {
            map.get(dislike[0]).add(dislike[1]);
            map.get(dislike[1]).add(dislike[0]);
        }
        for (int i = 1; i <= N; i++) if (colors[i] == 0 && !dfs(i, 1)) return false;

        return true;
    }

    private boolean dfs(int i, int color) {
        colors[i] = color;
        for (Integer index : map.get(i)) {
            if (colors[index] == color) return false;
            if (colors[index] == 0 && !dfs(index, -color)) return false;
        }
        return true;
    }

    public int[] father;

    /**
     * 并查集
     */
    public boolean possibleBipartition1(int N, int[][] dl) {
        father = new int[N * 2 + 1]; // self + dislike
        for (int i = 1; i <= N * 2; i++) father[i] = i;

        for (int i = 0; i < dl.length; i++) {
            int x = find(dl[i][0]); // 查找自己的根节点
            int y = find(dl[i][1]);
            int a = find(dl[i][0] + N); // 查找自己不喜欢的人的根节点
            int b = find(dl[i][1] + N);
            if (x == y)
                return false;
            else {
                father[a] = y; // 将不喜欢的人合并
                father[b] = x;
            }
        }
        return true;
    }

    private int find(int x) {
        if (x != father[x])
            father[x] = find(father[x]);
        return father[x];
    }

    private int find1(int x) {
        return x == father[x] ? x : (father[x] = find(father[x]));
    }
}
