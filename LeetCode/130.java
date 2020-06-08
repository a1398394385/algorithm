import java.util.HashSet;
import java.util.Set;

class Solution
{
    public int lenX, lenY;
    public boolean[][] flag;
    public int[][] temp;

    public char[][] solve(char[][] board) {
        lenY = board.length;
        if (lenY == 0) return new char[0][0];
        lenX = board[0].length;
        if (lenX == 0) return new char[0][0];

        Set<int[]> coordinates = new HashSet<>();
        for (int x = 0; x < lenX; x++) {
            if (board[0][x] == 'O')
                coordinates.add(new int[] {x, 0});
            if (board[lenY - 1][x] == 'O')
                coordinates.add(new int[] {x, lenY - 1});
        }
        for (int y = 0; y < lenY; y++) {
            if (board[y][0] == 'O')
                coordinates.add(new int[] {0, y});
            if (board[y][lenX - 1] == 'O')
                coordinates.add(new int[] {lenX - 1, y});
        }

        flag = new boolean[lenY][lenX];
        temp = new int[lenY][lenX];
        for (int[] coordinate : coordinates)
            dfs(coordinate[0], coordinate[1], board);
        for (int y = 0; y < lenY; y++) {
            for (int x = 0; x < lenX; x++) {
                board[y][x] = temp[y][x] == 1 ? 'O' : 'X';
            }
        }

        return board;
    }

    public char[][] solve1(char[][] board) {
        lenY = board.length;
        if (lenY == 0) return new char[0][0];
        lenX = board[0].length;
        if (lenX == 0) return new char[0][0];

        flag = new boolean[lenY][lenX];
        temp = new int[lenY][lenX];
        for (int x = 0; x < lenX; x++) {
            dfs(x, 0, board);
            dfs(x, lenY - 1, board);
        }
        for (int y = 0; y < lenY; y++) {
            dfs(0, y, board);
            dfs(lenX - 1, y, board);
        }

        for (int y = 0; y < lenY; y++)
            for (int x = 0; x < lenX; x++)
                if (temp[y][x] == 0)
                    board[y][x] = 'X';

        return board;
    }

    public void dfs(int x, int y, char[][] board) {
        if (x < 0 || y < 0 || x >= lenX || y >= lenY || flag[y][x]) return;
        flag[y][x] = true;
        if (board[y][x] == 'O') {
            temp[y][x] = 1;
            dfs(x + 1, y, board);
            dfs(x - 1, y, board);
            dfs(x, y + 1, board);
            dfs(x, y - 1, board);
        }
    }
}

