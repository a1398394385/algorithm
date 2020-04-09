<?php

/**
 * 题目描述
 * 统计一个数字在排序数组中出现的次数
 */


/**
 * 统计一个数字在排序数组中出现的次数
 *
 * @param array $data
 * @param int $k
 * @return int
 */
function GetNumberOfK($data, $k)
{
    $count = count($data) - 1;
    $left = 0;
    $right = $count;
    while ($left != $right) {
        $mid = floor(($right - $left) / 2) + $left;
        if ($data[$mid] < $k)
            $left = $mid + 1;
        else
            $right = $mid - 1;
    }
    if ($data[$left] != $k)
        return 0;
    while ($left > 0 && $data[$left - 1] == $k)
        $left--;
    while ($right < $count && $data[$right + 1] == $k)
        $right++;
    return $right - $left + 1;
}

function GetNumberOfK1($data, $k)
{
    $data = array_count_values($data);
    return $data[$k] ?? 0;
}


// TODO:Test
$array = [1, 1, 1, 1, 1, 1, 1, 1, 2, 3, 3, 3, 3, 3, 3, 3];
echo GetNumberOfK($array, 1);
