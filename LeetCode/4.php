<?php
class Solution
{
    public function findMedianSortedArrays($nums1, $nums2): float
    {
        $count1 = count($nums1);
        $count2 = count($nums2);
        $left = ($count1 + $count2 + 1) >> 1;
        $right = ($count1 + $count2 + 2) >> 1;
        return ($this->dp($nums1, 0, $count1, $nums2, 0, $count2, $left)
            + $this->dp($nums1, 0, $count1, $nums2, 0, $count2, $right)) * 0.5;
    }

    public function dp(array $nums1, int $start1, int $end1, array $nums2, int $start2, int $end2, int $k): float
    {
        $length1 = $end1 - $start1;
        $length2 = $end2 - $start2;
        if ($length1 > $length2)
            return $this->dp($nums2, $start2, $end2, $nums1, $start1, $end1, $k);
        if ($length1 == 0)
            return $nums2[$start2 + $k - 1];
        if ($k == 1)
            return min($nums1[$start1], $nums2[$start2]);

        $index1 = $start1 + min($length1, $k >> 1) - 1;
        $index2 = $start2 + min($length2, $k >> 1) - 1;
        if ($nums1[$index1] > $nums2[$index2]) {
            return $this->dp($nums1, $start1, $end1, $nums2, $index2 + 1, $end2, ($k + $start2 - $index2 - 1));
        } else {
            return $this->dp($nums1, $index1 + 1, $end1, $nums2, $start2, $end2, ($k + $start1 - $index1 - 1));
        }
    }
}
