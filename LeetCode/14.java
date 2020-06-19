class Solution
{
    static class TireNode
    {
        char value;
        TireNode[] children = new TireNode[26];

        TireNode(char value) {
            this.value = value;
        }
    }

    public String longestCommonPrefix(String[] strs) {
        if (strs.length == 0) return "";
        TireNode[] map = new TireNode[26];
        if (strs[0].length() == 0) return "";
        char[] chars = strs[0].toCharArray();
        TireNode root = map[chars[0] - 'a'] = new TireNode(chars[0]);
        for (int i = 1; i < chars.length; i++)
            root = root.children[chars[i] - 'a'] = new TireNode(chars[i]);

        String result = strs[0];
        for (int i = 1; i < strs.length; i++) {
            if (strs[i].length() == 0) return "";
            chars = strs[i].toCharArray();
            root = map[chars[0] - 'a'];
            if (root == null) return "";
            StringBuilder temp = new StringBuilder("").append(root.value);
            for (int j = 1; j < chars.length; j++) {
                root = root.children[chars[j] - 'a'];
                if (root != null)
                    temp.append(root.value);
                else
                    break;
            }
            if (temp.length() < result.length()) result = temp.toString();
        }
        return result;
    }

    public String longestCommonPrefix1(String[] strs) {
        if (strs.length == 0) return "";
        String prefix = strs[0];
        for (int i = 1; i < strs.length; i++)
            while (strs[i].indexOf(prefix) != 0) {
                prefix = prefix.substring(0, prefix.length() - 1);
                if (prefix.isEmpty()) return "";
            }
        return prefix;
    }
}
