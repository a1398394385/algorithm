class Solution
{
    public int translateNum(int num) {
        if (num == 0) return 1;
        if (num > 9) {
            int temp = num % 100;
            if (temp < 26 && temp > 9) return translateNum(num / 10) + translateNum(num / 100);
        }
        return translateNum(num / 10);
    }
}
