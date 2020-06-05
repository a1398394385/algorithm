class Solution
{
    public int numIslands(char[][] grid) {
        int result = 0;
        for (int i = 0, lenI = grid.length; i < lenI; ++i) {
            for (int j = 0, lenJ = grid[0].length; j < lenJ; ++j) {
                if (grid[i][j] == '1') {
                    dfs(grid, i, j);
                    result++;
                }
            }
        }
        return result;
    }

    public void dfs(char[][] grid, int i, int j) {
        if (i < 0 || i >= grid.length || j < 0 || j >= grid[0].length || grid[i][j] != '1') { return; }
        grid[i][j] = '2';
        dfs(grid, i + 1, j);
        dfs(grid, i - 1, j);
        dfs(grid, i, j + 1);
        dfs(grid, i, j - 1);
    }
}
