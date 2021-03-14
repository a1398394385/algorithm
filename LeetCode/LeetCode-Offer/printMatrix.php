<?php

/**
 * 剑指 Offer 29
 * 顺时针打印矩阵
 * 
 * 题目描述:
 * 输入一个矩阵，按照从外向里以顺时针的顺序依次打印出每一个数字。
 * 
 * 示例 1：
 * 输入：matrix = [[1,2,3],[4,5,6],[7,8,9]]
 * 输出：[1,2,3,6,9,8,7,4,5]
 * 
 * 示例 2：
 * 输入：matrix = [[1,2,3,4],[5,6,7,8],[9,10,11,12]]
 * 输出：[1,2,3,4,8,12,11,10,9,5,6,7]
 */
function printMatrix($matrix)
{
    $count = array_reduce($matrix, function ($carry, $item) {
        $carry += count($item);
        return $carry;
    });
    $array = [];
    $lineIndex = 0;
    $columnIndex = -1;
    $lineSymbol = 1;
    $columnSymbol = 1;
    for (
        $lineNum = count($matrix) - 1, $columnNum = count($matrix[0]);
        count($array) < $count;
        $columnNum--, $lineNum--, $columnSymbol = -$columnSymbol, $lineSymbol = -$lineSymbol
    ) {
        for ($i = 0; $i < $columnNum; $i++) {
            $columnIndex += $columnSymbol;
            $array[] = $matrix[$lineIndex][$columnIndex];
        }
        for ($i = 0; $i < $lineNum; $i++) {
            $lineIndex += $lineSymbol;
            $array[] = $matrix[$lineIndex][$columnIndex];
        }
    }

    return $array;
}

$arr = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12],
    [13, 14, 15, 16]
];

$arr = [
    [1, 2],
    [3, 4],
    [5, 6],
    [7, 8],
    [9, 10]
];

$arr = [
    [1, 2, 3, 4],
    [5, 6, 7, 8]
];

$arr = [[1], [2], [3], [4], [5]];

$arr = [
    [1, 2, 3, 4]
];

var_dump(printMatrix($arr));

/**
 * 1  2  3  4
 * 5  6  7  8
 * 9  10 11 12
 * 13 14 15 16
 *
 * We should print 1,2,3,4,8,12,16,15,14,13,9,5,6,7,11,10
 *
 * 1  2  3  4  5
 * 6  7  8  9  10
 * 11 12 13 14 15
 * 16 17 18 19 20
 * 21 22 23 24 25
 */
