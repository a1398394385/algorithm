public class Solution
{
    public int monotoneIncreasingDigits(int N) {
        char[] chars = String.valueOf(N).toCharArray();
        int i = 1, index = chars.length;
        while (true) {
            if (chars[i] < chars[i - 1]) {
                chars[i - 1]--;
                index = i;
                i = 1;
            } else {
                i++;
            }
            if (i == index) break;
        }
        if (index == chars.length) return N;
        return Integer.parseInt(String.valueOf(filling(chars, index)));
    }

    public char[] filling(char[] chars, int start) {
        for (int i = start; i < chars.length; i++) {
            chars[i] = '9';
        }
        return chars;
    }

    public int monotoneIncreasingDigits1(int N) {
        int rs = 0, exp = 1, p = 10;
        while (N > 0) {
            int t = N % 10;
            if (t <= p) {
                rs += t * exp;
                p = t;
            } else {
                rs = t * exp - 1;
                p = t - 1;
            }
            N /= 10;
            exp *= 10;
        }
        return rs;
    }
}
