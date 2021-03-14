import java.util.ArrayList;
import java.util.List;

class Solution
{
    public List<Integer> spiralOrder(int[][] matrix) {
        int M = matrix.length - 1, N = matrix[0].length;
        int m = 0, n = -1;
        List<Integer> result = new ArrayList<>();
        int size = 0, length = (M + 1) * N;
        for (int symbol = 1; size < length; symbol = -symbol) {
            for (int i = 0; i < N; i++) {
                n += symbol;
                result.add(matrix[m][n]);
            }
            for (int i = 0; i < M; i++) {
                m += symbol;
                result.add(matrix[m][n]);
            }
            size = result.size();
            M--;
            N--;
        }
        return result;
    }
}
