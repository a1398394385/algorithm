import java.util.ArrayList;
import java.util.List;

class Solution
{
    static class TrieNode
    {
        char value;
        int index = -1;
        TrieNode[] children = new TrieNode[26];

        TrieNode(char value) {
            this.value = value;
        }

        TrieNode(char value, int index) {
            this.value = value;
            this.index = index;
        }
    }

    public int[][] multiSearch(String big, String[] smalls) {
        if (big.length() == 0 || smalls.length == 0) return new int[smalls.length][0];

        int length = smalls.length;
        TrieNode[] map = new TrieNode[26];
        for (int index = 0; index < length; index++) {
            if (smalls[index].length() == 0) continue;
            char[] chars = smalls[index].toCharArray();
            if (map[chars[0] - 'a'] == null)
                map[chars[0] - 'a'] = new TrieNode(chars[0]);
            TrieNode root = map[chars[0] - 'a'];
            for (int i = 1, len = chars.length; i < len; i++) {
                if (root.children[chars[i] - 'a'] == null)
                    root.children[chars[i] - 'a'] = new TrieNode(chars[i]);
                root = root.children[chars[i] - 'a'];
            }
            root.index = index;
        }

        char[] chars = big.toCharArray();
        List<Integer>[] res = new ArrayList[length];
        for (int i = 0; i < length; i++)
            res[i] = new ArrayList<>();
        for (int i = 0, temp = 0, len = chars.length; i < len; temp = ++i) {
            TrieNode root = map[chars[temp] - 'a'];
            while (root != null) {
                if (root.index != -1) res[root.index].add(i);
                root = ++temp < len ? root.children[chars[temp] - 'a'] : null;
            }
        }

        int[][] result = new int[length][];
        for (int i = 0; i < length; i++)
            result[i] = res[i].stream().mapToInt(Integer::valueOf).toArray();
        return result;
    }
}
