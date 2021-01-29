class Solution
{
    public boolean isIsomorphic(String s, String t) {
        int[] m1 = new int[256];
        int[] m2 = new int[256];
        int len = s.length();
        for (int i = 0, x, y; i < len; i++) {
            x = s.charAt(i);
            y = t.charAt(i);
            if (m1[x] != m2[y])
                return false;
            m1[x] = m2[y] = i + 1;
        }
        return true;
    }
}
