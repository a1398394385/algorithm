import java.lang.reflect.Array;
import java.util.Arrays;
import java.util.stream.Collectors;

class Solution
{
    public int[] spiralOrder(int[][] matrix) {
        int X = matrix[0].length;
        if (X == 0) return new int[0];
        int Y = matrix.length - 1;
        int[] result = new int[X * (Y + 1)];
        int y = 0, x = -1;
        for (int index = 0, symbol = 1, len = result.length; index < len; symbol = -symbol) {
            for (int i = 0; i < X; ++i) {
                x += symbol;
                result[index++] = matrix[y][x];
            }
            for (int i = 0; i < Y; ++i) {
                y += symbol;
                result[index++] = matrix[y][x];
            }
            X--;
            Y--;
        }
        return result;
    }

    public static void main(String[] args) {
        // int[][] matrix = {{1, 2, 3}, {4, 5, 6}, {7, 8, 9}};
        // int[][] matrix = {{1, 2, 3, 4}, {5, 6, 7, 8}, {9, 10, 11, 12}};
        int[][] matrix = new int[0][];
        Solution solution = new Solution();
        System.out.println(Arrays.stream(solution.spiralOrder(matrix)).boxed().collect(Collectors.toList()));
    }
}
