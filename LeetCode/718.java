import java.util.HashSet;
import java.util.Set;

class Solution
{
    public int findLength(int[] A, int[] B) {
        if (A.length == 0 || B.length == 0) { return 0; }
        int[][] dp = new int[A.length + 1][B.length + 1];
        int result = 0;
        for (int i = 1; i <= A.length; i++) {
            for (int j = 1; j <= B.length; j++) {
                if (A[i - 1] == B[j - 1]) {
                    dp[i][j] = dp[i - 1][j - 1] + 1;
                    result = Math.max(result, dp[i][j]);
                }
            }
        }
        return result;
    }

    public int findLength1(int[] A, int[] B) {
        int n = A.length, m = B.length;
        int ret = 0;
        for (int i = 0; i < n; i++) {
            int len = Math.min(m, n - i);
            int maxlen = maxLength(A, B, i, 0, len);
            ret = Math.max(ret, maxlen);
        }
        for (int i = 0; i < m; i++) {
            int len = Math.min(n, m - i);
            int maxlen = maxLength(A, B, 0, i, len);
            ret = Math.max(ret, maxlen);
        }
        return ret;
    }

    public int maxLength(int[] A, int[] B, int addA, int addB, int len) {
        int ret = 0, k = 0;
        for (int i = 0; i < len; i++) {
            if (A[addA + i] == B[addB + i]) {
                k++;
            } else {
                k = 0;
            }
            ret = Math.max(ret, k);
        }
        return ret;
    }


    int base = 113;
    int mod = 1000000009;

    public int findLength2(int[] A, int[] B) {
        // [left, right]是所有可能不存在“对应长度的公共子数组”的集合（0是一定存在的，所以left从1开始，
        // 而Math.min(A.length , B.length) + 1是一定不存在的，所以也需要包含在内）
        int left = 1;
        int right = Math.min(A.length, B.length) + 1;
        while (left < right) {
            int mid = left + (right - left) / 2;
            if (check(A, B, mid))
                left = mid + 1;
            else
                right = mid;
        }
        return left - 1;
    }

    // 检验是否存在长度为len的公共子数组
    private boolean check(int[] a, int[] b, int len) {
        // 算出a[0, len - 1]的哈希值
        long hash_a = 0;
        for (int i = 0; i < len; i++) hash_a = (hash_a * base + a[i]) % mod;
        Set<Long> set_a = new HashSet<>();
        set_a.add(hash_a);
        // 根据公式递推后面对应长度的哈希值，并存入哈希表
        long ref = qPow(base, len - 1);
        for (int i = 0; i < a.length - len; i++) {
            // +mod是为了保证hash_a大于0
            hash_a = ((hash_a - a[i] * ref % mod + mod) % mod * base + a[i + len]) % mod;
            set_a.add(hash_a);
        }
        // 同样的方式处理B数组
        long hash_b = 0;
        for (int i = 0; i < len; i++) hash_b = (hash_b * base + b[i]) % mod;
        if (set_a.contains(hash_b)) return true;
        for (int i = 0; i < b.length - len; i++) {
            hash_b = ((hash_b - b[i] * ref % mod + mod) % mod * base + b[i + len]) % mod;
            if (set_a.contains(hash_b)) return true;
        }
        return false;
    }

    // 使用快速幂计算 x^n % mod 的值
    public long qPow(long x, long n) {
        long ret = 1;
        while (n != 0) {
            if ((n & 1) != 0) {
                ret = ret * x % mod;
            }
            x = x * x % mod;
            n >>= 1;
        }
        return ret;
    }
}
