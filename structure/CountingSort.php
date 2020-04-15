<?php

function countingSort(array $nums): array
{
    $count = count($nums);
    if ($count < 2)
        return $nums;
    $min = PHP_INT_MAX;
    $max = PHP_INT_MIN;
    for ($i = 0; $i < $count; $i++) {
        if ($nums[$i] < $min)
            $min = $nums[$i];
        if ($nums[$i] > $max)
            $max = $nums[$i];
    }
    $temp = new \SplFixedArray($max - $min - 1);
    for ($i = 0; $i < $count; $i++) {
        $temp[$nums[$i] - $min]++;
    }
    $index = 0;
    for ($i = 0; $i < $max - $min - 1; $i++) {
        for ($j = $temp[$i]; $j > 0; $j--)
            $arr[$index++] = $i + $min;
    }
    return $nums;
}

$nums = [9, 7, 8, 2, 2, 5, 1, 3, 6, 4];
var_dump(bubbleSort($nums));
