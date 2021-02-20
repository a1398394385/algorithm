import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

class Solution
{
    public static List<Integer> findSubstring(String s, String[] words) {
        if (words.length == 0) return new ArrayList<>();
        Map<String, Integer> map = new HashMap<>();
        for (String word : words) map.put(word, map.getOrDefault(word, 0) + 1);

        int len = words[0].length(), size = map.size(), strLen = words.length * len;
        List<Integer> result = new ArrayList<>();
        Map<String, Integer> countMap = new HashMap<>();
        for (int left = 0; left < s.length() - strLen + 1; left++) {
            int count = 0, right = left;
            countMap.clear();
            while (right < left + strLen) {
                String word = s.substring(right, right + len);
                Integer number = map.get(word);
                if (number == null) break;
                int temp = countMap.getOrDefault(word, 0);
                if (temp == number) break;
                countMap.put(word, ++temp);
                if (temp == number) count++;
                right += len;
            }
            if (count == size) result.add(left);
        }

        return result;
    }

    public static void main(String[] args) {
        System.err.println(findSubstring("wordgoodgoodgoodbestword", new String[] {"word", "good", "best", "word"}));
    }

    public List<Integer> findSubstring1(String s, String[] words) {

        ArrayList<Integer> result = new ArrayList<>();
        HashMap<String, Integer> wordMap = new HashMap<String, Integer>();
        for (String w : words) {
            int v = wordMap.getOrDefault(w, 0);
            wordMap.put(w, v + 1);
        }
        int wordLen = words[0].length();
        int len = words.length;
        int totalLen = wordLen * len;
        for (int i = 0; i < wordLen; i++) {
            int left = i;
            while (left <= s.length() - totalLen) {
                HashMap<String, Integer> newMap = new HashMap<>();
                int current = left;
                boolean flag = true;
                int right = current + totalLen;
                while (right > left) {
                    String w = s.substring(right - wordLen, right);
                    int newValue = newMap.getOrDefault(w, 0) + 1;
                    int wordCount = wordMap.getOrDefault(w, 0);
                    if (newValue > wordCount) {
                        left = right;
                        flag = false;
                        break;
                    }
                    right -= wordLen;
                    newMap.put(w, newValue);
                }
                if (flag) {
                    result.add(left);
                    left += wordLen;
                }
            }
        }
        return result;
    }
}
