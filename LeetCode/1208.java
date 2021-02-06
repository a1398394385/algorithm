class Solution
{
    public int equalSubstring(String s, String t, int maxCost) {
        int m = s.length();
        char[] sch = s.toCharArray();
        char[] tch = t.toCharArray();
        int[] result = new int[m];
        for (int i = 0; i < m; i++) {
            result[i] = Math.abs(sch[i] - tch[i]);
        }

        int max = 0, sum = 0;
        for (int left = 0, right = 0; right < result.length; right++) {
            sum += result[right];
            if (sum <= maxCost)
                max = Math.max(max, right - left + 1);
            else
                sum -= result[left++];
        }
        return max;
    }
}
