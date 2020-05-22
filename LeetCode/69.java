class Solution {
    public static double myPow(double x, long n) {
        if (n < 0)
            return 1 / myPow(x, -n);
        double ans = 1;
        while (true) {
            if ((n & 1) == 1)
                ans *= x;
            if ((n >>>= 1) == 0)
                break;
            x *= x;
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
        Solution.myPow(2.00000, 10);
    }
}
