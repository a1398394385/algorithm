<?php
class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function jump($nums)
    {
        $count = count($nums);
        $result = $index = 0;
        while ($index < $count - 1) {
            if ($nums[$index] + $index >= $count - 1)  return $result + 1;
            $nextIndex = $index;
            for ($i = 1; $i <= $nums[$index]; $i++) {
                if ($index + $i + $nums[$index + $i] > $nextIndex + $nums[$nextIndex])
                    $nextIndex = $index + $i;
            }
            $index = $nextIndex;
            $result += 1;
        }
        return $result;
    }
}


$en = new Solution();
var_dump($en->jump([2, 3, 1, 1, 4]));
var_dump($en->jump([1, 2, 3]));
var_dump($en->jump([1, 2]));
var_dump($en->jump([1]));
