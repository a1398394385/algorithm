import java.util.HashSet;
import java.util.LinkedList;
import java.util.List;
import java.util.Queue;
import java.util.Set;

class Solution
{

    static class TireNode
    {
        char value;
        boolean isWord = false;
        TireNode[] children = new TireNode[26];

        TireNode(char value) {
            this.value = value;
        }
    }

    public boolean wordBreak(String s, List<String> wordDict) {
        if (s.trim().equals("") || wordDict.isEmpty()) return false;
        int length = s.length();
        TireNode[] map = new TireNode[26];
        for (String word : wordDict) {
            char[] chars = word.toCharArray();
            if (map[chars[0] - 'a'] == null)
                map[chars[0] - 'a'] = new TireNode(chars[0]);
            TireNode root = map[chars[0] - 'a'];
            for (int i = 1, len = chars.length; i < len; i++) {
                if (root.children[chars[i] - 'a'] == null)
                    root.children[chars[i] - 'a'] = new TireNode(chars[i]);
                root = root.children[chars[i] - 'a'];
            }
            root.isWord = true;
        }

        boolean[] flag = new boolean[length];
        Queue<Integer> queue = new LinkedList<>();
        queue.add(0);
        while (queue.isEmpty() == false) {
            int index = queue.poll();
            TireNode root = map[s.charAt(index++) - 'a'];
            while (root != null && index < length) {
                if (root.isWord && flag[index] == false) {
                    queue.add(index);
                    flag[index] = true;
                }
                root = root.children[s.charAt(index++) - 'a'];
            }
            if (index == length && root != null && root.isWord) return true;
        }
        return false;
    }


    public boolean wordBreak1(String s, List<String> wordDict) {
        Set<String> wordDictSet = new HashSet<>(wordDict);
        boolean[] dp = new boolean[s.length() + 1];
        dp[0] = true;
        for (int i = 1; i <= s.length(); i++) {
            for (int j = 0; j < i; j++) {
                if (dp[j] && wordDictSet.contains(s.substring(j, i))) {
                    dp[i] = true;
                    break;
                }
            }
        }
        return dp[s.length()];
    }

    public boolean wordBreak2(String s, List<String> wordDict) {
        if (s == null || s.length() == 0) { return false; }
        Set<String> dic = new HashSet<>();
        int min = Integer.MAX_VALUE, max = 0;
        for (String str : wordDict) {
            int l = str.length();
            max = Math.max(l, max);
            min = Math.min(l, min);
            dic.add(str);
        }
        int len = s.length();
        boolean[] visit = new boolean[len + 1];
        visit[0] = true;
        for (int i = min; i <= len; i++) {
            int end = Math.min(i, max);
            for (int j = min; j <= end; j++) {
                if (visit[i - j] && dic.contains(s.substring(i - j, i))) {
                    visit[i] = true;
                    break;
                }
            }
        }
        return visit[len];
    }
}
