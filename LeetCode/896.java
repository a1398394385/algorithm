class Solution
{
    public boolean isMonotonic(int[] A) {
        if (A.length <= 1) return true;
        int a = 0, b = 0;
        for (int i = 0; i < A.length - 1; i++) {
            if (a == 0 && A[i] < A[i + 1]) a++;
            if (b == 0 && A[i] > A[i + 1]) b++;
        }
        return a == 0 || b == 0;
    }
}
