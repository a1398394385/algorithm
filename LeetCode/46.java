import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.stream.Collectors;

public class Solution
{
    public List<List<Integer>> permute(int[] nums) {
        List<Integer> numbers = Arrays.stream(nums).boxed().collect(Collectors.toList());
        List<List<Integer>> result = new ArrayList<>();
        List<List<Integer>> queue = new ArrayList<>();

        for (int i = 0; i < numbers.size(); i++) {
            swap(numbers, 0, i);
            queue.add(numbers);
            int flag = 0;

            while (queue.size() != 0) {
                flag++;

                if (flag == numbers.size()) {
                    result.addAll(queue);
                    queue.clear();
                    break;
                }
                int size = queue.size();

                while (size-- != 0) {
                    List<Integer> temp = queue.get(0);
                    queue.remove(0);

                    for (int j = flag; j < numbers.size(); j++) {
                        swap(temp, flag, j);
                        queue.add(Arrays.stream(temp.stream().mapToInt(Integer::valueOf).toArray())
                                .boxed()
                                .collect(Collectors.toList()));
                        swap(temp, flag, j);
                    }
                }
            }
            swap(numbers, 0, i);
        }
        return result;
    }

    public void swap(List<Integer> array, int idx1, int idx2) {
        int temp = array.get(idx1);
        array.set(idx1, array.get(idx2));
        array.set(idx2, temp);
    }

    public static void main(String[] args) {
        Solution test = new Solution();
        // test.permute(new int[] { 1, 2, 3 });
        System.out.println(test.permute(new int[] { 0, 1 }));
    }
}