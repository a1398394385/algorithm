class Solution
{
    public boolean validPalindrome(String s) {
        int i = 0, j = s.length() - 1;
        do {
            if (s.charAt(i) != s.charAt(j))
                return isValid(s, i + 1, j) || isValid(s, i, j - 1);
        } while (++i < --j);

        return true;
    }

    public boolean isValid(String s, int i, int j) {
        do {
            if (s.charAt(i) != s.charAt(j))
                return false;
        } while (++i < --j);

        return true;
    }

    public boolean validPalindrome1(String s) {
        int i = 0, j = s.length() - 1;
        int x, y;
        do {
            if (s.charAt(i) != s.charAt(j)) {
                x = i + 1;
                y = 1;
                do {
                    if (s.charAt(x) != s.charAt(y)) {
                        x = i;
                        y = j - 1;
                        do {
                            if (s.charAt(x) != s.charAt(y)) return false;
                        } while (++x < --y);
                        return true;
                    }
                } while (++x < --y);
                return true;
            }
        } while (++i < --j);

        return true;
    }
}
