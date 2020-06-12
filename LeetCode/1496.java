class Solution
{
    public String compressString(String S) {
        if (S.length() == 0) return "";
        StringBuilder sbl = new StringBuilder();
        char c = S.charAt(0);
        int num = 1;
        for (int i = 1, len = S.length(); i < len; i++) {
            if (S.charAt(i) != c) {
                sbl.append(c).append(num);
                c = S.charAt(i);
                num = 0;
            }
            num++;
        }
        sbl.append(c).append(num);
        return sbl.length() < S.length() ? sbl.toString() : S;
    }
}
