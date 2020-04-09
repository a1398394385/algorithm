<?php
/* 题目描述
在一个二维数组中（每个一维数组的长度相同），
每一行都按照从左到右递增的顺序排序，每一列都按照从上到下递增的顺序排序。
请完成一个函数，输入这样的一个二维数组和一个整数，判断数组中是否含有该整数。 */

/**
 * 暴力查找搜索
 * 时间复杂度：O(列高 * 行宽)
 */
function Find($target, $array)
{
    foreach ($array as $line) {
        foreach ($line as $value) {
            if ($value == $target) {
                return true;
            }
        }
    }

    return false;
}

/**
 * 二分查找搜索
 * 时间复杂度：O(行宽 * ㏒列高)
 */
function Find2($target, $array)
{
    if ($target > $array[count($array) - 1][count($array[1]) - 1]) {
        return false;
    }
    foreach ($array as $line) {
        if (BinarySearch($line, $target))
            return true;
    }

    return false;
}

/**
 * 二分查找
 * 时间复杂度：O(㏒n)
 */
function BinarySearch(array $array, int $data)
{
    if (count($array) > 2) {
        $conut = ceil(count($array) / 2);
        $arrays = array_chunk($array, $conut, true);

        $last = array_pop($arrays[0]);
        $next = array_shift($arrays[1]);

        if ($data == $last || $data == $next)
            return true;
        if ($data < $last)
            return BinarySearch($arrays[0], $data);
        if ($data > $next)
            return BinarySearch($arrays[1], $data);
    } else {
        foreach ($array as $value) {
            if ($value == $data) {
                return true;
            }
        }
    }

    return false;
}

/**
 * 二分查找搜索
 * 时间复杂度：O(行宽 * ㏒列高)
 */
function Find3($target, $array)
{
    if ($target > $array[count($array) - 1][count($array[1]) - 1]) {
        return false;
    }
    foreach ($array as $line) {
        $low  = 0;
        $high = count($line) - 1;
        while ($low <= $high) {
            $mid = floor(($low + $high) / 2);
            if ($target > $line[$mid])
                $low = $mid + 1;
            else if ($target < $line[$mid])
                $high = $mid - 1;
            else
                return true;
        }
    }

    return false;
}


/* 思路
* 矩阵是有序的，从左下角来看，向上数字递减，向右数字递增，
* 因此从左下角开始查找，当要查找数字比左下角数字大时。右移
* 要查找数字比左下角数字小时，上移
* 时间复杂度：O(行宽 + 列高)
*/
function Find4($target, $array)
{
    $x = 0;
    $y = count($array[0]) - 1;

    while ($x <= count($array) - 1 && $y <= count($array[0]) - 1) {
        if ($x < 0 || $y < 0)
            return false;
        if ($target < $array[$x][$y])
            $y -= 1;
        else if ($target > $array[$x][$y])
            $x += 1;
        else
            return true;
    }
}
