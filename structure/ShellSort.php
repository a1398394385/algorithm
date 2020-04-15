<?php
function ShellSort(array $nums): array
{
    $count = count($nums);
    for ($h = $count >> 1; $h > 0; $h >>= 1) {
        for ($start = 0; $start < $h; $start++) {
            for ($i = $start + $h; $i < $count; $i += $h) {
                for ($j = $i; $j - $h >= 0 && $nums[$j] < $nums[$j - $h]; $j -= $h) {
                    $tmep = $nums[$j - $h];
                    $nums[$j - $h] = $nums[$j];
                    $nums[$j] = $tmep;
                }
            }
        }
    }
    return $nums;
}

$nums = [9, 7, 8, 2, 5, 1, 3, 6, 4];
var_dump(ShellSort($nums));
