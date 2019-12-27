<?php

/**
 * quick sort
 *
 * @param array &$array 目标数组
 * @param int $left     数组左索引
 * @param int $right    数组右索引
 * @return void
 */
function QuickSort(array &$array, int $left, int $right): void
{
    if ($left >= $right)
        return;

    $l = $left;
    $r = $right;
    $pivot = $array[$l];
    while ($l < $r) {
        // from right to left
        for (; $l < $r && $array[$r] >= $pivot; $r--);
        if ($l < $r)
            $array[$l++] = $array[$r];
        // from left to right
        for (; $l < $r && $array[$l] <= $pivot; $l++);
        if ($l < $r)
            $array[$r--] = $array[$l];
    }
    $array[$l] = $pivot;
    QuickSort($array, $left, $l - 1);
    QuickSort($array, $l + 1, $right);
}


// TODO:Test
$array = range(1, 15);
shuffle($array);
QuickSort($array, 0, count($array) - 1);
var_dump($array);
