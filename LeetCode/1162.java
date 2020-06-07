import java.util.Arrays;

class Solution
{
    public int maxDistance(int[][] grid) {
        int lenX = grid[0].length, lenY = grid.length;
        int[][] temp = new int[lenY + 2][lenX + 2];
        for (int i = 0; i < lenY + 2; i++) {
            Arrays.fill(temp[i], 201);
        }
        for (int y = 1; y <= lenY; ++y) {
            for (int x = 1; x <= lenX; ++x) {
                if (grid[y - 1][x - 1] == 1) {
                    temp[y][x] = 0;
                } else {
                    temp[y][x] = Math.min(temp[y][x - 1], temp[y - 1][x]) + 1;
                }
            }
        }
        int result = -1;
        for (int y = lenY; y >= 1; --y) {
            for (int x = lenX; x >= 1; --x) {
                if (grid[y - 1][x - 1] == 1) {
                    temp[y][x] = 0;
                } else {
                    temp[y][x] = Math.min(temp[y][x], (Math.min(temp[y][x + 1], temp[y + 1][x]) + 1));
                    result = Math.max(temp[y][x], result);
                }
            }
        }
        return result > 200 ? -1 : result;
    }

    public static void main(String[] args) {
        Solution test = new Solution();
        System.out.println(test.maxDistance(new int[][] {{}}));
        System.out.println(test.maxDistance(new int[][] {{1, 0, 1}, {0, 0, 0}, {1, 0, 1}}));
        System.out.println(test.maxDistance(new int[][] {{0, 0, 0, 0}, {0, 0, 0, 0}, {0, 0, 0, 0}, {0, 0, 0, 0}}));
        System.out.println(test.maxDistance(new int[][] {{1, 1, 1, 1}, {1, 1, 1, 1}, {1, 1, 1, 1}, {1, 1, 1, 1}}));
    }
}
