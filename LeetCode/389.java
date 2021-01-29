class Solution
{
    public char findTheDifference(String s, String t) {
        int bitS = 0;
        for (char c : s.toCharArray()) {
            bitS ^= (1 << (c - 'a'));
        }
        int bitT = 0;
        for (char c : t.toCharArray()) {
            bitT ^= (1 << (c - 'a'));
        }

        int temp = bitS ^ bitT;
        for (int i = 0; i < 27; i++) {
            if ((temp & 1) == 1) return (char) ('a' + i);
            temp >>= 1;
        }
        return 'a';
    }

    public char findTheDifference1(String s, String t) {
        int length = s.length();
        char c = t.charAt(length);
        for (int i = 0; i < length; i++) {
            c ^= s.charAt(i);
            c ^= t.charAt(i);
        }
        return c;
    }
}
