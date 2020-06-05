import java.util.ArrayDeque;
import java.util.ArrayList;
import java.util.List;
import java.util.Queue;

class Solution
{
    public int shortestPathLength(int[][] graph) {
        int length = graph.length;
        int FINALLY_STATE = (1 << length) - 1;
        Queue<int[]> queue = new ArrayDeque<>();
        List<List<Integer>> cache = new ArrayList<>();
        for (int i = 0; i < length; i++) {
            queue.add(new int[] {i, 1 << i});
            cache.add(new ArrayList<>());
            cache.get(i).add(1 << i);
        }
        int result = -1;
        while (queue.isEmpty() == false) {
            ++result;
            int size = queue.size();
            while (size-- > 0) {
                int[] cur = queue.poll();
                int curNode = cur[0], curStatus = cur[1];
                if (curStatus == FINALLY_STATE) return result;
                for (int nextNode : graph[curNode]) {
                    int nextStatus = curStatus | (1 << nextNode);
                    if (cache.get(nextNode).contains(nextStatus)) continue;
                    queue.add(new int[] {nextNode, nextStatus});
                    cache.get(nextNode).add(nextStatus);
                }
            }
        }
        return result;
    }

    public int shortestPathLength1(int[][] graph) {
        int length = graph.length;
        int FINALLY_STATE = (1 << length) - 1;
        Queue<int[]> queue = new ArrayDeque<>();
        boolean[][] cache = new boolean[length][1 << 12];
        for (int i = 0; i < length; i++) {
            queue.add(new int[] {i, 1 << i, 0});
            cache[i][1 << i] = true;
        }
        while (queue.isEmpty() == false) {
            int[] cur = queue.poll();
            int curNode = cur[0], curStatus = cur[1], curStep = cur[2];
            if (curStatus == FINALLY_STATE) return curStep;
            for (int nextNode : graph[curNode]) {
                int nextStatus = curStatus | (1 << nextNode);
                if (cache[nextNode][nextStatus]) continue;
                queue.add(new int[] {nextNode, nextStatus, curStep + 1});
                cache[nextNode][nextStatus] = true;
            }
        }
        return -1;
    }
}
