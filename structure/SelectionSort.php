<?php

function selectionSort(array $nums): array
{
    $count = count($nums);
    for ($i = 0; $i < $count; $i++) {
        $min = $i;
        for ($j = $i; $j < $count; $j++) {
            if ($nums[$j] < $nums[$min])
                $min = $j;
        }
        $temp = $nums[$i];
        $nums[$i] = $nums[$min];
        $nums[$min] = $temp;
    }
    return $nums;
}

$nums = [9, 7, 8, 2, 5, 1, 3, 6, 4];
var_dump(selectionSort($nums));
