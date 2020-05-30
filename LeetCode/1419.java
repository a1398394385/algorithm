class Solution
{
    public int minNumberOfFrogs(String croakOfFrogs) {
        char[] chars = croakOfFrogs.toCharArray();
        int c = 0, r = 0, o = 0, a = 0, k = 0, result = 0;
        for (char i : chars) {
            if (i == 'c')
                c++;
            else if (i == 'r')
                r++;
            else if (i == 'o')
                o++;
            else if (i == 'a')
                a++;
            else if (i == 'k')
                k++;
            else
                return -1;
            if (r > c || o > r || a > o || k > a) return -1;
            if (k == 1) {
                --c;
                --r;
                --o;
                --a;
                --k;
            }
            result = c > result ? c : result;
        }
        if (c != 0) return -1;
        return result;
    }
}
