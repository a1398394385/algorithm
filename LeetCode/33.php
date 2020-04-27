<?php
class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target)
    {
        $count = count($nums);
        if ($nums[0] < $nums[$count - 1] && ($target < $nums[0] || $target > $nums[$count - 1])) return -1;
        $left = 0;
        $right = $count - 1;
        while ($left < $right) {
            $mid = ($left + $right) >> 1;
            if ($nums[$mid] == $target) return $mid;
            if ($nums[$mid] < $target) {
                if ($nums[$mid] <= $nums[$left]) {
                    if ($nums[$right] >= $target)
                        $left = $mid + 1;
                    else
                        $right = $mid - 1;
                } else {
                    $left = $mid + 1;
                }
            } else {
                if ($nums[$mid] >= $nums[$left]) {
                    if ($nums[$left] <= $target)
                        $right = $mid - 1;
                    else
                        $left = $mid + 1;
                } else {
                    $right = $mid - 1;
                }
            }
        }
        if ($nums[$left] == $target) return $left;
        return -1;
    }
}


$test = new Solution();
var_dump($test->search([1, 3], 3));
