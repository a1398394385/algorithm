class Solution
{
    public boolean checkInclusion(String s1, String s2) {
        int len1 = s1.length(), len2 = s2.length();
        if (len1 > len2) return false;
        char[] chars1 = s1.toCharArray(), chars2 = s2.toCharArray();
        int temp = 0, window = 0;
        int[] count1 = new int[256], count2 = new int[256];
        for (int i = 0; i < len1; i++)
            if (++count1[chars1[i]] == 1) temp++;
        for (int i = 0; i < len1; i++)
            if (++count2[chars2[i]] == count1[chars2[i]]) window++;

        if (window == temp) return true;
        for (int i = len1; i < len2; i++) {
            int left = chars2[i - len1], right = chars2[i];
            if (count2[left]-- == count1[left] && count1[left] != 0) window--;
            if (++count2[right] == count1[right]) window++;
            if (window == temp) return true;
        }
        return false;
    }
}
