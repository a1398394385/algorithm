class Solution
{
    public static String minWindow(String s, String t) {
        if (s == "" || t == "") return "";
        int sLength = s.length(), tLength = t.length();
        int[] counts = new int[64], tArray = new int[64];
        for (int i = 0; i < tLength; i++) tArray[t.charAt(i) - 'A']++;

        int start = sLength, end = sLength, length = sLength;
        for (int left = 0, right = 0, sum = 0; left < sLength;) {
            if (sum < tLength) {
                if (right == sLength) break;
                if (counts[s.charAt(right) - 'A'] < tArray[s.charAt(right) - 'A'])
                    sum++;
                counts[s.charAt(right++) - 'A']++;
            } else {
                if (right - left <= length) {
                    length = right - left;
                    start = left;
                    end = right;
                }
                if (counts[s.charAt(left) - 'A'] <= tArray[s.charAt(left) - 'A'])
                    sum--;
                counts[s.charAt(left++) - 'A']--;
            }
        }

        return s.substring(start, end);
    }

    public static void main(String[] args) {
        System.out.println(Solution.minWindow("ADOBECODEBANC", "ABC"));
        System.out.println(Solution.minWindow("a", "aa"));
        System.out.println(Solution.minWindow("a", "b"));
        System.out.println(Solution.minWindow("a", "a"));
        System.out.println(Solution.minWindow("aa", ""));
        System.out.println(Solution.minWindow("", "aa"));
    }
}
