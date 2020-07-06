class Solution
{
    public boolean isMatch(String s, String p) {
        if (s.equals("") && p.equals("")) return true;
        if (!s.equals("") && p.equals("")) return false;
        return name(s.toCharArray(), 0, p.toCharArray(), 0);
    }

    public boolean name(char[] string, int index1, char[] pattern, int index2) {
        if (index1 == string.length && index2 == pattern.length) return true;
        if (index1 != string.length && index2 == pattern.length) return false;

        if (index2 + 1 < pattern.length && pattern[index2 + 1] == '*') {
            if (index1 != string.length && (string[index1] == pattern[index2] || pattern[index2] == '.'))
                return name(string, index1, pattern, index2 + 2) || name(string, index1 + 1, pattern, index2);
            else
                return name(string, index1, pattern, index2 + 2);
        } else {
            if (index1 != string.length && (string[index1] == pattern[index2] || pattern[index2] == '.'))
                return name(string, index1 + 1, pattern, index2 + 1);
            else
                return false;
        }
    }
}
