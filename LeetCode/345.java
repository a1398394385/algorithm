class Solution
{
    public String reverseVowels(String s) {
        char[] chars = s.toCharArray();
        int l = 0, r = chars.length - 1;
        while (l < r) {
            while (l < r && isNoVowel(chars[l])) l++;
            while (l < r && isNoVowel(chars[r])) r--;
            if (l >= r) break;
            chars[l] ^= chars[r];
            chars[r] ^= chars[l];
            chars[l++] ^= chars[r--];
        }
        return String.valueOf(chars);
    }

    private boolean isNoVowel(char c) {
        switch (c) {
            case 'a':
            case 'e':
            case 'i':
            case 'o':
            case 'u':
            case 'A':
            case 'E':
            case 'I':
            case 'O':
            case 'U':
                return false;
        }
        return true;
    }
}
