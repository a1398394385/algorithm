class Solution
{
    public boolean isAnagram(String s, String t) {
        if (s.length() != t.length()) return false;
        int[] count = new int[26];
        char[] chars1 = s.toCharArray(), chars2 = t.toCharArray();
        for (int i = 0; i < chars1.length; i++) {
            count[chars1[i] - 'a']++;
            count[chars2[i] - 'a']--;
        }
        for (int i = 0; i < 256; i++) {
            if (count[i] != 0) return false;
        }
        return true;
    }
}
