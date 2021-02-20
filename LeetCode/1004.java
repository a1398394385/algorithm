class Solution
{
    public int longestOnes(int[] A, int K) {
        int result = 0;
        int left = 0, right = 0, count = 0;
        while (right < A.length) {
            if (A[right++] == 0) count++;
            if (count > K) {
                result = Math.max(right - left - 1, result);
                while (count > K) if (A[left++] == 0) count--;
            }
        }
        if (count > K)
            result = Math.max(right - left - 1, result);
        else
            result = Math.max(right - left, result);
        return result;
    }

    public static int longestOnes1(int[] A, int K) {
        int len = A.length;
        int left = 0, right = 0, maxCount = 0;
        while (right < len) {
            if (A[right++] == 0) {
                maxCount++;
            }
            if (maxCount > K) {
                if (A[left++] == 0) {
                    maxCount--;
                }
            }
        }
        return right - left;
    }
}
