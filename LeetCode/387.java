class Solution
{
    public int firstUniqChar(String s) {
        if (s == null || s.trim().length() == 0) return -1;
        int[] count = new int[26];
        char[] chars = s.toCharArray();
        for (int i = 0; i < chars.length; i++) {
            count[chars[i] - 'a']++;
        }
        for (int i = 0; i < chars.length; i++) {
            if (count[chars[i] - 'a'] == 1) return i;
        }
        return -1;
    }
}
