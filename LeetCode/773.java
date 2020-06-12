import java.util.HashSet;
import java.util.LinkedList;
import java.util.Queue;
import java.util.Set;

class Solution
{
    public int slidingPuzzle(int[][] board) {
        StringBuilder start = new StringBuilder("");
        String target = "123450";
        for (int i = 0; i < 2; i++)
            for (int j = 0; j < 3; j++)
                start.append(board[i][j]);

        // 二维转一维
        // [0, 1, 2]
        // [3, 4, 5]
        // 数组中每一项表示对应索引位置可行的下一步索引位置
        int[][] automata = {{1, 3}, {0, 4, 2}, {1, 5}, {0, 4}, {3, 1, 5}, {4, 2}};

        Queue<String> queue = new LinkedList<>();
        queue.add(start.toString());
        Set<String> set = new HashSet<>();
        set.add(start.toString());
        int result = 0;
        while (queue.isEmpty() == false) {
            int size = queue.size();
            while (size-- > 0) {
                String curr = queue.poll();
                if (curr.equals(target)) return result;
                int zero = curr.indexOf("0");
                for (int direction : automata[zero]) {
                    String next = swap(curr, zero, direction);
                    if (set.contains(next) == false) {
                        queue.add(next);
                        set.add(next);
                    }
                }
            }
            result++;
        }
        return -1;
    }

    public String swap(String str, int i1, int i2) {
        char[] chars = str.toCharArray();
        char temp = chars[i1];
        chars[i1] = chars[i2];
        chars[i2] = temp;
        return String.valueOf(chars);
    }
}
