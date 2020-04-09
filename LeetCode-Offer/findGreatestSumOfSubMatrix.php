<?php

/**
 * 已知矩阵的大小定义为矩阵中所有元素的和。
 * 给定一个矩阵，你的任务是找到最大的非空(大小至少是1 * 1)子矩阵。
 * 比如，如下4 * 4的矩阵
 * 0 -2 -7 0 9 2 -6 2 -4 1 -4 1 -1 8 0 -2 的最大子矩阵是
 * 9 2 -4 1 -1 8 这个子矩阵的大小是15。
 *
 * 输入描述:
 * 输入是一个N * N的矩阵。输入的第一行给出N (0 < N <= 100)。
 * 再后面的若干行中，
 * 依次（首先从左到右给出第一行的N个整数，再从左到右给出第二行的N个整数……）给出矩阵中的N2个整数，
 * 整数之间由空白字符分隔（空格或者空行）。已知矩阵中整数的范围都在[-127, 127]。
 *
 * example:
 * 输入
 * 4
 * 0 -2 -7 0
 * 9 2 -6 2
 * -4 1 -4  1
 * -1 8  0 -2
 *
 * 输出
 * 15
 */

function findGreatestSumOfSubMatrix($n, $matrix)
{
    $result = $matrix[0][0];
    $tempArr = array_fill(0, $n, 0);
    for ($line = 0; $line < $n; $line++) {
        $temp = $tempArr;
        for ($y = $line; $y >= 0; $y--) {
            $max = $res = 0;
            for ($index = 0; $index < $n; $index++) {
                $temp[$index] += $matrix[$y][$index];
                $max = $index == 0 ? $temp[0] : max($max + $temp[$index], $temp[$index]);
                $res = $index == 0 ? $temp[0] : max($max, $res);
            }
            $result = max($res, $result);
        }
    }
    return $result;
}


// TODO:Test
$input = explode('
', fread(STDIN, 10000));
array_pop($input);
$n = array_shift($input);
$temp = array_map(function ($value) {
    return explode(' ', $value);
}, $input);
$matrix = [];
for ($x = 0; $x < $n; $x++) {
    for ($y = 0; $y < $n; $y++) {
        $matrix[$x][$y] = (int) $temp[$x][$y];
    }
}
echo findGreatestSumOfSubMatrix($n, $matrix);
