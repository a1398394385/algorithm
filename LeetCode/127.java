import java.util.ArrayDeque;
import java.util.HashSet;
import java.util.List;
import java.util.Queue;
import java.util.Set;

class Solution
{
    public int ladderLength(String beginWord, String endWord, List<String> wordList) {
        if (wordList.contains(endWord) == false) return 0;
        Queue<String> queue = new ArrayDeque<>();
        wordList.add(beginWord);
        queue.add(endWord);
        int result = 0;
        while (queue.isEmpty() == false) {
            ++result;
            int size = queue.size();
            while (size-- > 0) {
                String currWord = queue.poll();
                if (currWord.equals(beginWord)) return result;
                wordList.remove(currWord);
                for (String word : wordList) {
                    if (isReachable(currWord, word)) {
                        if (queue.contains(word) == false) queue.add(word);
                    }
                }
            }
        }
        return 0;
    }

    public boolean isReachable(String word1, String word2) {
        int num = 0;
        char[] char1 = word1.toCharArray();
        char[] char2 = word2.toCharArray();
        for (int i = 0, len = char1.length; i < len; ++i) {
            if (char1[i] != char2[i])
                if (++num == 2)
                    return false;
        }
        return num == 1;
    }

    public int ladderLength1(String beginWord, String endWord, List<String> wordList) {
        if (wordList == null || wordList.size() == 0) return 0;
        if (wordList.contains(endWord) == false) return 0;
        Set<String> start = new HashSet<>();
        Set<String> end = new HashSet<>();
        Set<String> dict = new HashSet<>(wordList);
        start.add(beginWord);
        end.add(endWord);
        return bfs(start, end, dict, 2);
    }

    public int bfs(Set<String> start, Set<String> end, Set<String> dict, int deep) {
        if (start.size() == 0) return 0;
        if (start.size() > end.size())
            return bfs(end, start, dict, deep);
        dict.removeAll(start);
        Set<String> next = new HashSet<>();
        for (String nextStart : start) {
            char[] arr = nextStart.toCharArray();
            for (int i = 0; i < arr.length; i++) {
                char tmp = arr[i];
                for (char c = 'a'; c <= 'z'; c++) {
                    arr[i] = c;
                    String nstr = new String(arr);
                    if (dict.contains(nstr)) {
                        if (end.contains(nstr))
                            return deep;
                        else
                            next.add(nstr);
                    }
                }
                arr[i] = tmp;
            }
        }
        return bfs(next, end, dict, deep + 1);
    }
}
