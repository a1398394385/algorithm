class Solution
{
    public String removeDuplicates(String S) {
        if (S.length() == 1) return S;
        char[] chars = S.toCharArray();
        int index = -1;
        for (char c : chars) {
            if (index != -1 && c == chars[index]) {
                index--;
            } else {
                chars[++index] = c;
            }
        }
        return new String(chars, 0, index + 1);
    }

    /**
     * 奇怪的做法增加了
     */
    public String removeDuplicates1(String S) {
        int now = S.length();
        int next = 1;
        while (now != next) {
            now = S.length();
            S = S.replace("aa", "").replace("bb", "").replace("cc", "").replace("dd", "").replace("ee", "")
                    .replace("ff", "").replace("gg", "").replace("hh", "").replace("ii", "").replace("jj", "")
                    .replace("kk", "").replace("ll", "").replace("mm", "").replace("nn", "").replace("oo", "")
                    .replace("pp", "").replace("qq", "").replace("rr", "").replace("ss", "").replace("tt", "")
                    .replace("uu", "").replace("vv", "").replace("ww", "").replace("xx", "").replace("yy", "")
                    .replace("zz", "");
            next = S.length();
        }
        return S;
    }

    public static void main(String[] args) {
        char[] chars = new char[6];
        chars[0] = '0';
        chars[1] = '1';
        chars[2] = '2';
        System.err.println(String.valueOf(chars));
    }
}
