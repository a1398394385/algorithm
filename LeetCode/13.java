class Solution
{
    int[] map = new int[] {0, 0, 100, 500, 0, 0, 0, 0, 1, 0, 0, 50, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 10, 0, 0};

    public int romanToInt(String s) {
        int result = 0;
        for (int i = 0; i < s.length() - 1; i++) {
            if (map[s.charAt(i) - 'A'] < map[s.charAt(i + 1) - 'A'])
                result -= map[s.charAt(i) - 'A'];
            else
                result += map[s.charAt(i) - 'A'];
        }
        result += map[s.charAt(s.length() - 1) - 'A'];
        return result;
    }
}
