class Solution
{
    public boolean isPalindrome(String s) {
        if (s.length() == 0) return true;
        char[] chars = s.toCharArray();
        int left = 0, right = chars.length - 1;
        while (left < right) {
            while (left < right && isCorrectCharacter(chars[left]) == false) left++;
            while (left < right && isCorrectCharacter(chars[right]) == false) right--;
            if ('a' <= chars[left] && chars[left] <= 'z') chars[left] -= 32;
            if ('a' <= chars[right] && chars[right] <= 'z') chars[right] -= 32;
            if (chars[left++] != chars[right--]) return false;
        }
        return true;
    }

    public boolean isCorrectCharacter(char c) {
        return ('0' <= c && c <= '9') || ('A' <= c && c <= 'Z') || ('a' <= c && c <= 'z');
    }
}
