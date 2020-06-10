import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

class Solution
{
    static class TireNode
    {
        char value;
        int index = -1;
        TireNode[] children = new TireNode[26];
        Set<Integer> suffixes = new HashSet<>();

        TireNode(char value) {
            this.value = value;
        }
    }

    public List<List<Integer>> palindromePairs(String[] words) {
        if (words.length == 0) return new ArrayList<>();

        int length = words.length;
        TireNode tree = new TireNode(' ');
        for (int index = 0; index < length; index++) {
            String word = new StringBuilder(words[index]).reverse().toString();
            if (isPalindrome(word.substring(0))) tree.suffixes.add(index);
            TireNode root = tree;
            for (int i = 0, len = word.length(); i < len; i++) {
                if (root.children[word.charAt(i) - 'a'] == null)
                    root.children[word.charAt(i) - 'a'] = new TireNode(word.charAt(i));
                root = root.children[word.charAt(i) - 'a'];
                if (isPalindrome(word.substring(i + 1))) root.suffixes.add(index);
            }
            root.index = index;
        }

        List<List<Integer>> result = new ArrayList<>();
        for (int index = 0; index < length; index++) {
            String word = words[index];
            TireNode root = tree;
            for (int i = 0, len = word.length(); i < len; i++) {
                if (root.index != -1 && root.index != index)
                    if (isPalindrome(word.substring(i)))
                        result.add(Arrays.asList(index, root.index));
                root = root.children[word.charAt(i) - 'a'];
                if (root == null) break;
            }
            if (root != null)
                for (int rootIndex : root.suffixes)
                    if (rootIndex != index) result.add(Arrays.asList(index, rootIndex));
        }

        return result;
    }

    public boolean isPalindrome(String str) {
        int left = 0, right = str.length() - 1;
        while (left <= right)
            if (str.charAt(left++) != str.charAt(right--))
                return false;
        return true;
    }
}


class Solution1
{
    public List<List<Integer>> palindromePairs(String[] words) {
        List<List<Integer>> result = new ArrayList<>();
        for (int i = 0, len = words.length; i < len; i++) {
            for (int j = i + 1; j < len; j++) {
                if (isPalindrome(words[i] + words[j]))
                    result.add(Arrays.asList(new Integer[] {i, j}));
                if (isPalindrome(words[j] + words[i]))
                    result.add(Arrays.asList(new Integer[] {j, i}));
            }
        }
        return result;
    }

    public boolean isPalindrome(String str) {
        int left = 0, right = str.length() - 1;
        while (left <= right)
            if (str.charAt(left++) != str.charAt(right--))
                return false;
        return true;
    }
}
