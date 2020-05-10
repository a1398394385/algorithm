class Solution {
    public static double myPow(double x, long n) {
        if (n < 0)
            return 1 / myPow(x, -n);
        double res = x;
        double ans = 1;
        while (n > 0) {
            if ((n & 1) == 1) {
                ans *= res;
            }
            res *= res;
            n = n >> 1;
        }
        return ans;
    }

    public static double myPow1(double x, long n) {
        if (n == 0)
            return 1;
        if (n < 0)
            return 1 / myPow1(x, -n);
        double mid = myPow1(x, n >> 1);
        if ((n & 1) == 1)
            return mid * mid * x;
        return mid * mid;
    }

    public static void main(String[] args) {
        long n = -2147483648;
        long x = n * -1;
        System.out.println(n);
        System.out.println(x);
        // System.out.println(Solution.myPow(1.00000, -2147483648));
    }
}
