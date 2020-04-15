<?php

function mergeSort(array $nums): array
{
    $count = count($nums);
    $nums = merge($nums, 0, $count - 1);
    unset($nums[$count]);
    return $nums;
}

function merge(array $nums, int $left, int $right): array
{
    if ($left == $right) return [$nums[$left], PHP_INT_MAX];
    $mid = ($left + $right) >> 1;
    $arr1 = merge($nums, $left, $mid);
    $arr2 = merge($nums, $mid + 1, $right);
    $temp = [];
    for ($i1 = $i2 = 0; $i1 <= ($mid - $left) || $i2 != ($right - $mid);) {
        if ($nums[$i1] < $nums[$i2])
            $temp[] = $nums[$i1++];
        else
            $temp[] = $nums[$i2++];
    }
    return [...$temp, PHP_INT_MAX];
}

$nums = [9, 7, 8, 2, 5, 1, 3, 6, 4];
var_dump(mergeSort($nums));
