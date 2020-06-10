class Solution
{
    public static String reverseOnlyLetters(String S) {
        if (S.length() == 0) return S;
        char[] chars = S.toCharArray();
        int left = 0, right = S.length() - 1;
        while (left < right) {
            while (left < right
                    && (chars[left] < 'A' || chars[left] > 'z' || (chars[left] > 'Z' && chars[left] < 'a')))
                left++;
            while (left < right
                    && (chars[right] < 'A' || chars[right] > 'z' || (chars[right] > 'Z' && chars[right] < 'a')))
                right--;
            char temp = chars[left];
            chars[left++] = chars[right];
            chars[right--] = temp;
        }
        return String.valueOf(chars);
    }
}
