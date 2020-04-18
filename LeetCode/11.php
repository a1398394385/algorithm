<?php
class Solution
{

    /**
     * @param Integer[] $height
     * @return Integer
     */
    function maxArea($height)
    {
        $count = count($height);
        $max = 0;
        for ($left = 0, $right = $count - 1; $left < $right;) {
            $max = max($max, min($height[$left], $height[$right]) * ($right - $left));
            if ($height[$left] > $height[$right]) {
                $right--;
            } else {
                $left++;
            }
        }
        return $max;
    }
}

$test = new Solution();
var_dump($test->maxArea([1, 8, 6, 2, 5, 4, 8, 3, 7]));
