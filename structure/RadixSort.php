<?php
function radixSort(array $nums): array
{
    $count = count($nums);
    if ($count < 2)
        return $nums;
    $max = $nums[0];
    for ($i = 1; $i < $count; $i++)
        if ($nums[$i] > $max) $max = $nums[$i];
    $digits = 0;
    while ($max) {
        $digits++;
        $max = floor($max / 10);
    }
    $bucketList = array_fill(0, 10, []);
    for ($i = 1; $i <= $digits; $i++) {
        for ($j = 0; $j < $count; $j++)
            $bucketList[floor($nums[$j] / pow(10, $i - 1)) % 10][] = $nums[$j];
        $nums = [];
        foreach ($bucketList as $bucket) {
            foreach ($bucket as $value) {
                $nums[] = $value;
            }
        }
        $bucketList = array_fill(0, 10, []);
    }
    return $nums;
}


$nums = [9, 7, 8, 2, 2, 5, 1, 3, 6, 4];
var_dump(radixSort($nums));
