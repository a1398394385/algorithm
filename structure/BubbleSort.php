<?php
function bubbleSort(array $nums): array
{
    $count = count($nums);
    for ($i = $count - 1; $i > 0; $i--) {
        $flag = true;
        for ($j = 0; $j < $i; $j++) {
            if ($nums[$j] > $nums[$j + 1]) {
                $flag = false;
                $temp = $nums[$j];
                $nums[$j] = $nums[$j + 1];
                $nums[$j + 1] = $temp;
            }
        }
        if ($flag) break;
    }
    return $nums;
}

$nums = [9, 7, 8, 2, 2, 5, 1, 3, 6, 4];
var_dump(bubbleSort($nums));
