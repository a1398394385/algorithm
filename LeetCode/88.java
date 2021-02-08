class Solution
{
    public static void merge(int[] nums1, int m, int[] nums2, int n) {
        int idx = 0, idx1 = 0, idx2 = 0;
        int[] result = new int[n + m];
        while (idx1 < m && idx2 < n) {
            if (nums1[idx1] <= nums2[idx2])
                result[idx++] = nums1[idx1++];
            else
                result[idx++] = nums2[idx2++];
        }
        while (idx1 < m) result[idx++] = nums1[idx1++];
        while (idx2 < n) result[idx++] = nums2[idx2++];
        for (int i = 0; i < result.length; i++) nums1[i] = result[i];
    }
}
