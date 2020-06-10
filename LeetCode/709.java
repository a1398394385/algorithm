class Solution
{
    public String toLowerCase(String str) {
        if (str.length() == 0) return str;
        char[] chars = str.toCharArray();
        for (int i = 0, len = chars.length; i < len; i++)
            if ('A' <= chars[i] && chars[i] <= 'Z')
                chars[i] += 32;
        return String.valueOf(chars);
    }
}
