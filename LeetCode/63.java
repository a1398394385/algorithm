import java.util.LinkedList;
import java.util.Queue;

class Solution
{
    public int uniquePathsWithObstacles(int[][] obstacleGrid) {
        if (obstacleGrid.length == 0 || obstacleGrid[0].length == 0) return 0;
        if (obstacleGrid[0][0] == 1 || obstacleGrid[obstacleGrid.length - 1][obstacleGrid[0].length - 1] == 1) return 0;
        return dfs(0, 0, obstacleGrid);
    }

    public int dfs(int x, int y, int[][] paths) {
        if (x == paths.length - 1 && y == paths[0].length - 1) return 1;
        if (x >= paths.length || y >= paths[0].length || paths[x][y] == 1) return 0;
        return dfs(x + 1, y, paths)
                + dfs(x, y + 1, paths);
    }

    public int uniquePathsWithObstaclesBFS(int[][] obstacleGrid) {
        if (obstacleGrid.length == 0 || obstacleGrid[0].length == 0) return 0;
        int len1 = obstacleGrid.length, len2 = obstacleGrid[0].length;
        if (obstacleGrid[0][0] == 1 || obstacleGrid[len1 - 1][len2 - 1] == 1) return 0;

        Queue<int[]> queue = new LinkedList<>();
        queue.add(new int[] {0, 0});
        int result = 0;
        while (queue.isEmpty() == false) {
            int[] coordinate = queue.poll();
            int x = coordinate[0], y = coordinate[1];
            if (x == len1 - 1 && y == len2 - 1) result += 1;
            if (x + 1 < len1 && obstacleGrid[x + 1][y] == 0) queue.add(new int[] {x + 1, y});
            if (y + 1 < len2 && obstacleGrid[x][y + 1] == 0) queue.add(new int[] {x, y + 1});
        }
        return result;
    }

    public int uniquePathsWithObstaclesDP(int[][] obstacleGrid) {
        if (obstacleGrid.length == 0 || obstacleGrid[0].length == 0) return 0;
        int len1 = obstacleGrid.length, len2 = obstacleGrid[0].length;
        if (obstacleGrid[0][0] == 1 || obstacleGrid[len1 - 1][len2 - 1] == 1) return 0;

        int[][] dp = new int[len1][len2];
        dp[0][0] = 1;
        for (int i = 0; i < len1; i++) {
            for (int j = 0; j < len2; j++) {
                if (i + 1 < len1 && obstacleGrid[i + 1][j] == 0) dp[i + 1][j] += dp[i][j];
                if (j + 1 < len2 && obstacleGrid[i][j + 1] == 0) dp[i][j + 1] += dp[i][j];
            }
        }
        return dp[len1 - 1][len2 - 1];
    }


    public int uniquePathsWithObstaclesDPAndBfs(int[][] obstacleGrid) {
        if (obstacleGrid.length == 0 || obstacleGrid[0].length == 0) return 0;
        int len1 = obstacleGrid.length, len2 = obstacleGrid[0].length;
        if (obstacleGrid[0][0] == 1 || obstacleGrid[len1 - 1][len2 - 1] == 1) return 0;

        int[][] dp = new int[len1][len2];
        dp[0][0] = 1;
        boolean[][] flag = new boolean[len1][len2];
        flag[0][0] = true;
        Queue<int[]> queue = new LinkedList<>();
        queue.add(new int[] {0, 0});
        while (queue.isEmpty() == false) {
            int[] coordinate = queue.poll();
            int x = coordinate[0], y = coordinate[1];
            if (x + 1 < len1 && obstacleGrid[x + 1][y] == 0) {
                dp[x + 1][y] += dp[x][y];
                if (flag[x + 1][y] == false) {
                    queue.add(new int[] {x + 1, y});
                    flag[x + 1][y] = true;
                }
            }
            if (y + 1 < len2 && obstacleGrid[x][y + 1] == 0) {
                dp[x][y + 1] += dp[x][y];
                if (flag[x][y + 1] == false) {
                    queue.add(new int[] {x, y + 1});
                    flag[x][y + 1] = true;
                }
            }
        }
        return dp[len1 - 1][len2 - 1];
    }
}
