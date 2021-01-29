class Solution
{
    public static void rotate(int[][] matrix) {
        if (matrix == null) return;
        int n = matrix.length;
        for (int y = 0; y < n; y++) {
            for (int x = 0; x < n - y; x++) {
                int temp = matrix[y][x];
                matrix[y][x] = matrix[n - 1 - x][n - 1 - y];
                matrix[n - 1 - x][n - 1 - y] = temp;
            }
        }
        for (int y = 0; y < (n >> 1); y++) {
            for (int x = 0; x < n; x++) {
                int temp = matrix[y][x];
                matrix[y][x] = matrix[n - 1 - y][x];
                matrix[n - 1 - y][x] = temp;
            }
        }
    }
}
