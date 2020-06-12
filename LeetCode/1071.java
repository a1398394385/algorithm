class Solution
{
    public String gcdOfStrings(String str1, String str2) {
        if ((str1 + str2).equals(str2 + str1) == false) return "";
        return str1.substring(0, gcd(str1.length(), str2.length()));
    }

    public int gcd(int x, int y) {
        if (x < y) return gcd(y, x);
        return y == 0 ? x : gcd(y, x % y);
    }
}
