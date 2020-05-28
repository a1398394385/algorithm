<?php

class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function massage($nums)
    {
        $count = count($nums);
        $a = $b = 0;
        for ($i = 0; $i < $count; $i++) {
            $temp = max($b, $a + $nums[$i]);
            $a = $b;
            $b = $temp;
        }
        return $b;
    }
}
