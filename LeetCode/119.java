import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

class Solution
{
    public List<Integer> getRow(int rowIndex) {
        List<Integer> res = new ArrayList<>(rowIndex + 1);
        long cur = 1;
        for (int i = 0; i <= rowIndex; i++) {
            res.add((int) cur);
            cur = cur * (rowIndex - i) / (i + 1);
        }
        return res;
    }

    public List<Integer> getRow1(int rowIndex) {
        Integer[] dp = new Integer[rowIndex + 1];
        Arrays.fill(dp, 1);
        for (int i = 1; i < rowIndex; i++) {
            for (int j = i; j > 0; j--) {
                dp[j] = dp[j] + dp[j - 1];
            }
        }
        return Arrays.asList(dp);
    }
}
