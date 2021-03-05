class NumMatrix
{
    int[][] matrix;
    int[][] presum;

    public NumMatrix(int[][] matrix) {
        this.matrix = matrix;
        int m = matrix.length;
        int n = 0;
        if (m != 0) n = matrix[0].length;
        presum = new int[m][n + 1];
        for (int i = 0; i < m; i++) {
            for (int j = 1; j < n + 1; j++) {
                presum[i][j] = presum[i][j - 1] + matrix[i][j - 1];
            }
        }
    }

    public int sumRegion(int row1, int col1, int row2, int col2) {
        int sum = 0;
        for (int i = row1; i <= row2; i++) {
            sum += presum[i][col2 + 1] - presum[i][col1];
        }
        return sum;
    }
}
