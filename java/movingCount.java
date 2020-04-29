class Solution
{
    public int movingCount(int m, int n, int k) {
        int result = 0;
        int capX = k > 8 ? (k - 7) * 10 : 10;

        for (int i = 0; i < m && i < capX; i++) {
            int temp = sum(i);
            int capY = capX - (i / 10) * 10;

            for (int j = 0; j < n && j < capY; j++) {
                if (temp + sum(j) <= k)
                    result += 1;
            }
        }
        return result;
    }

    private int sum(int num) {
        int result = 0;

        while (num > 0) {
            result += num % 10;
            num    /= 10;
        }
        return result;
    }
}
