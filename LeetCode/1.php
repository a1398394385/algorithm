<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target)
    {
        $temp = $result = [];
        $count = count($nums);
        for ($i = 0; $i < $count; $i++) {
            if (key_exists($nums[$i], $temp)) {
                return [$i, $temp[$nums[$i]]];
            }
            $temp[$target - $nums[$i]] = $i;
        }
        return [];
    }
}
