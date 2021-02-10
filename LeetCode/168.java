class Solution
{
    public String convertToTitle(int n) {
        if (n < 0) return "";
        StringBuilder sbl = new StringBuilder();
        while (n > 0) {
            n--;
            sbl.append((char) (n % 26 + 'A'));
            n = n / 26;
        }
        return sbl.reverse().toString();
    }
}
