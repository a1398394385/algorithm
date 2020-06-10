class Solution
{
    public int lengthOfLastWord(String s) {
        if (s.length() == 0) return 0;
        int right = s.length() - 1;
        while (right > 0 && s.charAt(right) == ' ') right--;
        if (right == 0) return s.charAt(0) == ' ' ? 0 : 1;
        int left = right;
        while (left >= 0 && s.charAt(left) != ' ') left--;
        return right - left;
    }
}
