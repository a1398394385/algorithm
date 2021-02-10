class Solution
{
    public int subarraysWithKDistinct(int[] A, int k) {
        int result = 0;
        for (int i = 0; i < A.length - k + 1; i++) {
            int diff = 0, point = i;
            boolean[] flag = new boolean[A.length + 1];
            while (point < A.length && diff <= k) {
                if (!flag[A[point]]) {
                    flag[A[point]] = true;
                    diff++;
                }
                if (diff == k) result++;
                point++;
            }
        }
        return result;
    }


    public int subarraysWithKDistinct1(int[] A, int K) {
        return atMostKDistinct(A, K) - atMostKDistinct(A, K - 1);
    }

    /**
     * @return 最多包含 K 个不同整数的子区间的个数
     */
    private int atMostKDistinct(int[] A, int K) {
        int result = 0, left = 0, right = 0, diff = 0;
        int[] count = new int[A.length + 1];
        while (right < A.length) {
            if (++count[A[right++]] == 1) diff++;
            while (diff > K)
                if (--count[A[left++]] == 0) diff--;
            result += right - left;
        }
        return result;
    }

    public static int subarraysWithKDistinct2(int[] A, int K) {
        int left = 0, right = 0, diff = 0, result = 0;
        int[] count = new int[A.length + 1];
        while (right < A.length) {
            if (++count[A[right++]] == 1) diff++;
            while (diff > K)
                if (--count[A[left++]] == 0) diff--;

            if (diff == K) {
                int leftTemp = left;
                while (diff == K) {
                    if (--count[A[leftTemp++]] == 0) diff--;
                    result++;
                }
                for (int i = left; i < leftTemp; i++)
                    if (count[A[i]]++ == 0) diff++;
            }
        }
        return result;
    }
}
