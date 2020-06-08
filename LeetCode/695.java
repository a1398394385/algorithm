class Solution
{
    public int lenX, lenY;

    public int maxAreaOfIsland(int[][] grid) {
        lenY = grid.length;
        if (lenY == 0) return 0;
        lenX = grid[0].length;
        if (lenX == 0) return 0;

        int result = 0;
        for (int y = 0; y < lenY; y++) {
            for (int x = 0; x < lenX; x++) {
                if (grid[y][x] == 1) {
                    int acreage = dfs(x, y, grid);
                    result = acreage > result ? acreage : result;
                }
            }
        }

        return result;
    }

    public int dfs(int x, int y, int[][] grid) {
        if (x < 0 || y < 0 || x >= lenX || y >= lenY || grid[y][x] != 1) return 0;
        grid[y][x] = 2;
        return dfs(x + 1, y, grid) + dfs(x - 1, y, grid) + dfs(x, y + 1, grid) + dfs(x, y - 1, grid) + 1;
    }
}
