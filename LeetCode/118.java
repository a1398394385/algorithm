import java.util.ArrayList;
import java.util.List;

class Solution
{
    public List<List<Integer>> generate(int numRows) {
        List<List<Integer>> result = new ArrayList<>();
        int[] cache = new int[] {1};
        for (int i = 1; i <= numRows; i++) {
            List<Integer> list = new ArrayList<>();
            int[] temp = new int[i];
            for (int j = 0; j < i; j++) {
                if (j == 0 || j == i - 1) {
                    list.add(1);
                    temp[j] = 1;
                    continue;
                }
                list.add(cache[j - 1] + cache[j]);
                temp[j] = cache[j - 1] + cache[j];
            }
            result.add(list);
            cache = temp;
        }
        return result;
    }
}
