import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.HashSet;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Set;

class Solution
{

    public List<List<String>> result;
    public int minDeep;
    public Map<String, Integer> map;

    public List<List<String>> findLadders(String beginWord, String endWord, List<String> wordList) {
        if (wordList == null || wordList.size() == 0) return new ArrayList<>();
        if (wordList.contains(endWord) == false) return new ArrayList<>();
        result = new ArrayList<>();
        minDeep = wordList.size();
        map = new HashMap<>();
        dfs(beginWord, endWord, "", 1, new HashSet<>(wordList));
        return result;
    }

    public void dfs(String begin, String end, String path, int deep, Set<String> wordList) {
        path += begin + ",";
        if (begin.equals(end)) {
            if (deep < minDeep) {
                minDeep = deep;
                result.clear();
                result.add(Arrays.asList(path.split(",")));
            } else if (deep == minDeep) {
                result.add(Arrays.asList(path.split(",")));
            }
            return;
        }
        List<String> list = new ArrayList<>();
        char[] arr = begin.toCharArray();
        for (int i = 0; i < arr.length; i++) {
            char temp = arr[i];
            for (char c = 'a'; c <= 'z'; c++) {
                arr[i] = c;
                String nstr = new String(arr);
                if (map.getOrDefault(nstr, deep) >= deep && wordList.contains(nstr)) {
                    list.add(nstr);
                    map.put(nstr, deep);
                }
            }
            arr[i] = temp;
        }
        for (String word : list) {
            dfs(word, end, path, deep + 1, wordList);
        }
    }
}


class Solution1
{
    public Map<String, List<String>> tree;
    public List<List<String>> paths;

    public List<List<String>> findLadders(String beginWord, String endWord, List<String> wordList) {
        if (wordList == null || wordList.size() == 0) return paths;
        if (wordList.contains(endWord) == false) return paths;
        tree = new HashMap<>();
        paths = new ArrayList<>();
        Set<String> dict = new HashSet<>(wordList);
        Set<String> start = new HashSet<>();
        Set<String> end = new HashSet<>();
        start.add(beginWord);
        end.add(endWord);
        bfs(start, end, dict, true);
        dfs(beginWord, endWord, new LinkedList<>());
        return paths;
    }

    public boolean bfs(Set<String> start, Set<String> end, Set<String> dict, boolean isFront) {
        if (start.size() == 0) return false;
        if (start.size() > end.size())
            return bfs(end, start, dict, !isFront);
        dict.removeAll(start);

        boolean result = false;
        Set<String> next = new HashSet<>();
        for (String head : start) {
            char[] chars = head.toCharArray();
            for (int i = 0; i < chars.length; ++i) {
                char temp = chars[i];
                for (char c = 'a'; c <= 'z'; ++c) {
                    chars[i] = c;
                    String tail = new String(chars);
                    if (dict.contains(tail)) {
                        next.add(tail);
                        result |= end.contains(tail);
                        String key = isFront ? head : tail;
                        String value = isFront ? tail : head;
                        if (tree.containsKey(key) == false)
                            tree.put(key, new ArrayList<>());
                        tree.get(key).add(value);
                    }
                }
                chars[i] = temp;
            }
        }
        return result || bfs(next, end, dict, isFront);
    }

    public void dfs(String begin, String end, LinkedList<String> path) {
        path.add(begin);
        if (begin.equals(end))
            paths.add(new ArrayList<>(path));
        if (tree.containsKey(begin))
            for (String word : tree.get(begin))
                dfs(word, end, path);
        path.removeLast();
    }
}
