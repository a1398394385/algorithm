class Solution
{
    public String reverseWords(String s) {
        StringBuilder result = new StringBuilder();
        s = s.trim();
        char[] chars = s.toCharArray();
        for (int i = 0; i < chars.length;) {
            if (chars[i] == ' ') {
                result.append(chars[i++]);
                continue;
            }
            int end = i;
            while (end < chars.length && chars[end] != ' ') end++;
            result.append(reverse(s.substring(i, end)));
            i = end;
        }
        return result.toString();
    }

    public String reverse(String str) {
        StringBuilder builder = new StringBuilder();
        for (int i = str.length() - 1; i >= 0; i--) {
            builder.append(str.charAt(i));
        }
        return builder.toString();
    }
}
