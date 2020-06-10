class Solution
{
    public boolean isPalindrome(int x) {
        char[] chars = String.valueOf(x).toCharArray();
        int left = 0, right = chars.length - 1;
        while (left <= right)
            if (chars[left++] != chars[right--])
                return false;
        return true;
    }

    public boolean isPalindrome1(int x) {
        if (x < 0 || (x != 0 && x % 10 == 0)) { return false; }
        int rev = 0;
        while (x > rev) {
            rev = rev * 10 + x % 10;
            x /= 10;
        }
        return x == rev || x == rev / 10;
    }
}
