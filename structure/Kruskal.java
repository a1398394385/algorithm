import java.util.ArrayList;
import java.util.List;
import java.util.PriorityQueue;
import java.util.stream.IntStream;

public class Kruskal
{
    public int[] father;

    public List<int[]> Kruskal(int num, int[][] sides) {
        PriorityQueue<int[]> minHeap = new PriorityQueue<>((int[] newValue, int[] oldValue) -> {
            return newValue[2] - oldValue[2];
        });
        for (int[] side : sides) {
            minHeap.add(side);
        }

        father = IntStream.rangeClosed(0, num).toArray();
        List<int[]> result = new ArrayList<>();
        while (minHeap.isEmpty() == false) {
            int[] side = minHeap.poll();
            if (find(side[0]) != find(side[1])) {
                merge(side[0], side[1]);
                result.add(side);
            }
        }
        return result;
    }

    public List<int[]> Kruskal1(int num, int[][] sides) {
        PriorityQueue<int[]> minHeap = new PriorityQueue<>((int[] newValue, int[] oldValue) -> {
            return newValue[2] - oldValue[2];
        });
        for (int[] side : sides) {
            minHeap.add(side);
        }

        father = IntStream.rangeClosed(0, num).toArray();
        List<int[]> result = new ArrayList<>();
        while (minHeap.isEmpty() == false) {
            int[] side = minHeap.poll();
            if (findAndMerge(side[0], side[1]))
                result.add(side);
        }
        return result;
    }

    public int Kruskal2(int num, int[][] sides) {
        PriorityQueue<int[]> minHeap = new PriorityQueue<>((int[] newValue, int[] oldValue) -> {
            return newValue[2] - oldValue[2];
        });
        for (int[] side : sides) {
            minHeap.add(side);
        }

        father = IntStream.rangeClosed(0, num).toArray();
        int result = 0;
        while (minHeap.isEmpty() == false) {
            int[] side = minHeap.poll();
            if (findAndMerge(side[0], side[1]))
                result += side[2];
        }
        return result;
    }

    public int find(int node) {
        if (father[node] == node)
            return node;
        return father[node] = find(father[node]);
    }

    public void merge(int x, int y) {
        int xFather = find(x);
        int yFather = find(y);
        if (xFather != yFather) father[xFather] = yFather;
    }

    public boolean findAndMerge(int x, int y) {
        int xFather = find(x);
        int yFather = find(y);
        if (xFather == yFather)
            return false;
        father[xFather] = yFather;
        return true;
    }
}
