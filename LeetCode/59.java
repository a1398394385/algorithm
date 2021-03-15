class Solution
{
    public int[][] generateMatrix(int n) {
        int[][] matrix = new int[n][n];
        int x = 0, y = -1, count = n * n;;
        for (int index = 1, symbol = 1; index <= count; symbol = -symbol) {
            for (int i = 0; i < n; i++) {
                y += symbol;
                matrix[x][y] = index++;
            }
            for (int i = 0; i < n - 1; i++) {
                x += symbol;
                matrix[x][y] = index++;
            }
            n--;
        }
        return matrix;
    }
}
