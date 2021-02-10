import java.util.Arrays;

class Solution
{
    public int countPrimes(int n) {
        int[] isPrime = new int[n];
        Arrays.fill(isPrime, 1);
        int ans = 0;
        for (int i = 2; i < n; ++i) {
            if (isPrime[i] == 1) {
                ans += 1;
                if ((long) i * i < n) {
                    for (int j = i * i; j < n; j += i) {
                        isPrime[j] = 0;
                    }
                }
            }
        }
        return ans;
    }

    public static int countPrimes1(int n) {
        if (n < 3) { return 0; }
        boolean[] arr = new boolean[n];
        int count = n / 2;
        for (int i = 3; i * i < n; i += 2) {
            if (arr[i]) continue;
            for (int j = i * i; j < n; j += 2 * i) {
                if (!arr[j]) {
                    count--;
                    arr[j] = true;
                }
            }
        }
        return count;
    }
}
