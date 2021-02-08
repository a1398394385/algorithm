class Solution
{
    public int maxScore(int[] cardPoints, int k) {
        int length = cardPoints.length, sum = 0;
        for (int i : cardPoints) sum += i;
        int min = Integer.MAX_VALUE, temp = 0;
        int len = length - k;
        for (int i = 0; i < length; i++) {
            temp += cardPoints[i];
            if (i >= len) temp -= cardPoints[i - len];
            if (i >= len - 1) min = Math.min(min, temp);
        }
        return sum - min;
    }

    public int maxScore1(int[] cardPoints, int k) {
        int sum = 0;
        for (int i = 0; i < k; i++) sum += cardPoints[i];
        int len = cardPoints.length;
        int windowSum = sum;
        for (int i = 1; i <= k; i++) {
            windowSum -= cardPoints[k - i];
            windowSum += cardPoints[len - i];
            sum = Math.max(sum, windowSum);
        }
        return sum;
    }
}
