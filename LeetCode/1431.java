import java.util.ArrayList;
import java.util.List;

class Solution
{
    public List<Boolean> kidsWithCandies(int[] candies, int extraCandies) {
        int max = 0, length = candies.length;
        int[] temp = new int[length];
        for (int i = 0; i < length; i++) {
            max = candies[i] > max ? candies[i] : max;
            temp[i] = candies[i] + extraCandies;
        }
        List<Boolean> result = new ArrayList<>();
        for (int i = 0; i < length; i++) {
            result.add(temp[i] - max >= 0);
        }
        return result;
    }
}
