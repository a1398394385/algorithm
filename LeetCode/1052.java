class Solution
{
    public int maxSatisfied(int[] customers, int[] grumpy, int X) {
        int result = 0, length = customers.length;
        for (int i = 0; i < length; i++) {
            if (grumpy[i] == 1) continue;
            result += customers[i];
            customers[i] = 0;
        }
        int sum = 0;
        for (int i = 0; i < X; i++) sum += customers[i];
        int max = sum;
        for (int i = X; i < length; i++) {
            sum += customers[i];
            sum -= customers[i - X];
            max = Math.max(sum, max);
        }
        return result + max;
    }
}
