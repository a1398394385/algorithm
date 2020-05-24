class Solution
{
    public double findMedianSortedArrays(int[] nums1, int[] nums2) {
        int len1 = nums1.length, len2 = nums2.length;
        int one = (len1 + len2 + 1) >>> 1;
        int two = (len1 + len2 + 2) >>> 1;
        return (findTheKthInSortedArray(nums1, 0, len1, nums2, 0, len2, one)
                + findTheKthInSortedArray(nums1, 0, len1, nums2, 0, len2, two))
                * 0.5;
    }

    public double findTheKthInSortedArray(int[] nums1, int start1, int end1, int[] nums2, int start2, int end2, int k) {
        int len1 = end1 - start1, len2 = end2 - start2;
        if (len1 > len2) return findTheKthInSortedArray(nums2, start2, end2, nums1, start1, end1, k);
        if (len1 == 0) return nums2[start2 + k - 1];
        if (k == 1) return nums1[start1] < nums2[start2] ? nums1[start1] : nums2[start2];

        int index1 = start1 + (len1 < (k >>> 1) ? len1 : k >>> 1) - 1;
        int index2 = start2 + (len2 < (k >>> 1) ? len2 : k >>> 1) - 1;
        if (nums1[index1] < nums2[index2])
            return findTheKthInSortedArray(nums1, index1 + 1, end1, nums2, start2, end2, k - (index1 - start1 + 1));
        else
            return findTheKthInSortedArray(nums1, start1, end1, nums2, index2 + 1, end2, k - (index2 - start2 + 1));
    }

    public double findMedianSortedArrays1(int[] nums1, int[] nums2) {
        if (nums1.length > nums2.length) return findMedianSortedArrays1(nums2, nums1);

        int len1 = nums1.length, len2 = nums2.length, median = (len1 + len2 + 1) >>> 1;
        int left = 0, right = len1;
        int lMax = 0, rMin = 0;

        while (left <= right) {
            // nums1 切割为 nums1[0 ... index1 - 1] | nums1[index1 ... len1 - 1]
            // muns2 切割为 nums2[0 ... index2 - 1] | nums2[index2 ... len2 - 1]
            int index1 = (left + right) >>> 1;
            int index2 = median - index1;

            // lMax1, lMax2 左半部分两个数组的最大值
            int lMax1 = (index1 == 0 ? Integer.MIN_VALUE : nums1[index1 - 1]);
            int lMax2 = (index2 == 0 ? Integer.MIN_VALUE : nums2[index2 - 1]);
            // rMin1, rMin2 右半部分两个数组的最小值
            int rMin1 = (index1 == len1 ? Integer.MAX_VALUE : nums1[index1]);
            int rMin2 = (index2 == len2 ? Integer.MAX_VALUE : nums2[index2]);

            if (lMax1 <= rMin2) {
                lMax = lMax1 > lMax2 ? lMax1 : lMax2;
                rMin = rMin1 < rMin2 ? rMin1 : rMin2;
                left = index1 + 1;
            } else {
                right = index1 - 1;
            }
        }

        return ((len1 + len2) & 1) == 1 ? lMax : (lMax + rMin) * 0.5;
    }

    public double findMedianSortedArrays2(int[] A, int[] B) {
        int len1 = A.length;
        int len2 = B.length;
        int len = len1 + len2;
        int left = -1, right = -1;
        int aStart = 0, bStart = 0;
        for (int i = 0; i <= len / 2; i++) {
            left = right;
            if (aStart < len1 && (bStart >= len2 || A[aStart] < B[bStart])) {
                right = A[aStart++];
            } else {
                right = B[bStart++];
            }
        }
        if ((len & 1) == 0)
            return (left + right) / 2.0;
        else
            return right;
    }

    public static void main(String[] args) {
        System.out.println(1 & 1);
    }
}
