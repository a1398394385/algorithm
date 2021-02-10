class Solution
{
    public int titleToNumber(String s) {
        int temp = 1, result = 0;
        for (int i = s.length() - 1; i >= 0; i--) {
            result += (s.charAt(i) - '@') * temp;
            temp *= 26;
        }
        return result;
    }
}
