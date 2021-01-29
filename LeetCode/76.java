class Solution
{
    public static String minWindow(String s, String t) {
        if (s == "" || t == "" || (s.length() < t.length())) return "";
        int sLen = s.length(), tLen = t.length();
        int[] counts = new int[126], tArr = new int[126];
        for (int i = 0; i < tLen; i++) tArr[t.charAt(i)]++;

        int start = sLen, end = sLen, length = sLen;
        char[] chars = s.toCharArray();
        for (int left = 0, right = 0, sum = 0; left < sLen;) {
            if (sum < tLen) {
                if (right == sLen)
                    break;
                if (counts[chars[right]] < tArr[chars[right]])
                    sum++;
                counts[chars[right++]]++;
            } else {
                if (right - left <= length)
                    length = (end = right) - (start = left);
                if (counts[chars[left]] == tArr[chars[left]])
                    sum--;
                counts[chars[left++]]--;
            }
        }

        return s.substring(start, end);
    }
}
