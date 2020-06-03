<?php

function bucketSort(array $nums, int $bucketSize = null): array
{
    $count = count($nums);
    if ($count <= 1) return $nums;
    $min = $max = $nums[0];
    for ($i = 0; $i < $count; $i++) {
        if ($nums[$i] < $min) {
            $min = $nums[$i];               // 输入数据的最小值
        } else if ($nums[$i] > $max) {
            $max = $nums[$i];               // 输入数据的最大值
        }
    }

    $bucketSize = $bucketSize ?? 5;         // 设置桶的默认大小为5
    $bucketCount = floor(($max - $min) / $bucketSize) + 1;
    $buckets = array_fill(0, $bucketCount, []);

    for ($i = 0; $i < $count; $i++) {
        $buckets[floor(($nums[$i] - $min) / $bucketSize)][] = $nums[$i];
    }

    $result = [];
    for ($i = 0, $count = count($buckets); $i < $count; $i++) {
        $buckets[$i] = insertionSort($buckets[$i]);     // 对每个桶进行排序，这里使用了插入排序
        for ($j = 0, $countI = count($buckets[$i]); $j < $countI; $j++) {
            $result[] = $buckets[$i][$j];
        }
    }
    return $result;
}

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
var_dump(bucketSort($nums));
