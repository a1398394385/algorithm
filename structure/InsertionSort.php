<?php
function insertionSort(array $nums): array
{
    $count = count($nums);
    for ($i = 1; $i < $count; $i++) {
        for ($j = $i; $j > 0 && $nums[$j] < $nums[$j - 1]; $j--) {
            $temp = $nums[$j - 1];
            $nums[$j - 1] = $nums[$j];
            $nums[$j] = $temp;
        }
    }
    return $nums;
}

$nums = [9, 7, 8, 2, 5, 1, 3, 6, 4];
var_dump(insertionSort($nums));
