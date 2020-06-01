import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.stream.Collectors;
import java.util.stream.IntStream;

class Solution
{
    public static int[][] findContinuousSequence(int target) {
        List<int[]> result = new ArrayList<>();
        List<Integer> tempList = IntStream.rangeClosed(1, (target + 1) >>> 1).boxed().collect(Collectors.toList());
        int[] numbers = tempList.stream().mapToInt(Integer::valueOf).toArray();
        int low = 1, high = low + 1;
        while (high > low) {
            int sum = ((low + high) * (high - low + 1)) >>> 1;
            if (sum < target) {
                high++;
                continue;
            }

            if (sum == target) {
                int[] temp = new int[high - low + 1];
                System.arraycopy(numbers, low - 1, temp, 0, high - low + 1);
                result.add(temp);
            }
            low++;
        }

        return result.toArray(new int[0][]);
    }

    public static int[][] findContinuousSequence1(int target) {
        List<int[]> result = new ArrayList<>();
        int low = 1, high = low + 1;
        while (high > low) {
            int sum = ((low + high) * (high - low + 1)) >>> 1;
            if (sum < target) {
                high++;
                continue;
            }
            if (sum == target) {
                int[] temp = new int[high - low + 1];
                for (int i = 0, len = high - low + 1; i < len; i++)
                    temp[i] = i + low;
                result.add(temp);
            }
            low++;
        }
        return result.toArray(new int[0][]);
    }

    public static int[][] findContinuousSequence2(int target) {
        List<int[]> result = new ArrayList<>();
        int len = 1;
        while (target > 0) {
            target -= len++;
            if (target > 0 && target % len == 0) {
                int[] temp = new int[len];
                for (int i = 0, x = target / len; i < len; i++)
                    temp[i] = x + i;
                result.add(temp);
            }
        }
        Collections.reverse(result);
        return result.toArray(new int[0][]);
    }

    public static int[][] findContinuousSequence3(int target) {
        List<int[]> result = new ArrayList<>();
        int maxLen = (int) (Math.sqrt((double) (target * 2)) + 1);
        for (int len = maxLen; len >= 2; len--) {
            if ((target * 2) % len == 0) {
                int tmp = target * 2 / len - len + 1;
                if (tmp > 0 && tmp % 2 == 0) {
                    int[] temp = new int[len];
                    for (int i = 0, a = tmp / 2; i < len; ++i) {
                        temp[i] = i + a;
                    }
                    result.add(temp);
                }
            }
        }
        return result.toArray(new int[0][]);
    }
}
