import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

class Solution
{
    public static List<Integer> findNumOfValidWords(String[] words, String[] puzzles) {
        Map<Integer, Integer> map = new HashMap<>();
        for (int i = 0; i < words.length; i++) {
            int bit = 0;
            for (char c : words[i].toCharArray()) bit |= (1 << (c - 'A'));
            map.put(bit, map.getOrDefault(bit, 0) + 1);
        }
        List<Integer> result = new ArrayList<>();
        for (int i = 0; i < puzzles.length; i++) {
            int count = 0, bit = 0, subbit = 0, first = 1 << (puzzles[i].charAt(0) - 'A');
            for (char c : puzzles[i].toCharArray()) bit |= 1 << (c - 'A');
            subbit = bit ^= first;
            do {
                count += map.getOrDefault(first | subbit, 0);
                subbit = (subbit - 1) & bit;
            } while (subbit != bit);
            result.add(count);
        }
        return result;
    }
}
