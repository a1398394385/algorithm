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
        if ($count < 2)
            return empty($nums) ? 0 : $nums[0];
        $temp[0] = $nums[0];
        $temp[1] = max($nums[0], $nums[1]);
        for ($i = 2; $i < $count; $i++) {
            $temp[$i] = max($temp[$i - 1], $temp[$i - 2] + $nums[$i]);
        }
        return $temp[$count - 1];
    }

    function rob($nums)
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
