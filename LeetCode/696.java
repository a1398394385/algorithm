class Solution
{
    public int countBinarySubstrings(String s) {
        int last = 0, cur = 1, res = 0;
        for (int i = 1; i < s.length(); i++) {
            if (s.charAt(i) == s.charAt(i - 1)) {
                cur++;
            } else {
                last = cur;
                cur = 1;
            }
            if (last >= cur) res++;
        }
        return res;
    }

    public int countBinarySubstrings1(String s) {
        int last = 0, cur = 1, res = 0;
        char[] chars = s.toCharArray();
        for (int i = 1; i < chars.length; i++) {
            if (chars[i] == chars[i - 1]) {
                cur++;
            } else {
                last = cur;
                cur = 1;
            }
            if (last >= cur) res++;
        }
        return res;
    }
};
