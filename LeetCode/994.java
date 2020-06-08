import java.util.LinkedList;
import java.util.Queue;

class Solution
{
    public int orangesRotting(int[][] grid) {
        int lenY = grid.length;
        if (lenY == 0) return 0;
        int lenX = grid[0].length;
        if (lenX == 0) return 0;

        Queue<int[]> queue = new LinkedList<>();
        for (int y = 0; y < lenY; y++)
            for (int x = 0; x < lenX; x++)
                if (grid[y][x] == 2)
                    queue.add(new int[] {x, y});

        int minute = 0;
        boolean[][] flag = new boolean[lenY][lenX];
        while (queue.isEmpty() == false) {
            int size = queue.size();
            while (size-- > 0) {
                int[] coordinate = queue.poll();
                int x = coordinate[0], y = coordinate[1];
                grid[y][x] = 2;
                if (x + 1 < lenX && flag[y][x + 1] == false && grid[y][x + 1] == 1) {
                    queue.add(new int[] {x + 1, y});
                    flag[y][x + 1] = true;
                }
                if (x - 1 >= 0 && flag[y][x - 1] == false && grid[y][x - 1] == 1) {
                    queue.add(new int[] {x - 1, y});
                    flag[y][x - 1] = true;
                }
                if (y + 1 < lenY && flag[y + 1][x] == false && grid[y + 1][x] == 1) {
                    queue.add(new int[] {x, y + 1});
                    flag[y + 1][x] = true;
                }
                if (y - 1 >= 0 && flag[y - 1][x] == false && grid[y - 1][x] == 1) {
                    queue.add(new int[] {x, y - 1});
                    flag[y - 1][x] = true;
                }
            }
            if (queue.isEmpty() == false) minute++;
        }

        for (int y = 0; y < lenY; y++)
            for (int x = 0; x < lenX; x++)
                if (grid[y][x] == 1)
                    return -1;

        return minute;
    }

    public static void main(String[] args) {
        Solution test = new Solution();
        test.orangesRotting(new int[][] {{2, 2}, {1, 1}, {0, 0}, {2, 0}});
    }
}
