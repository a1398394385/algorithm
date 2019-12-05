<?php
require '../vendor/autoload.php';

/**
 * 开启 PHP-DocBlocker
 */
class A
{ }

/**
 * 整数快速幂
 *
 * @param int $x 整数
 * @param int $n 次方数
 */
function QuickPow(int $x, int $n)
{
    $res = $x;
    $ans = 1;
    while ($n) {
        if ($n & 1) {
            $ans *= $res;
        }
        $res *= $res;
        $n = $n >> 1;
    }

    return $ans;
}

/**
 * 矩阵乘法
 *
 * @param array $a 矩阵 A
 * @param array $b 矩阵 B
 * @param int $line 矩阵 A 的行数
 * @param int $column 矩阵 B 的列数
 * @param int $number 矩阵 AB 的共通数
 */
function MatrixMultiplication(array $a, array $b, int $line, int $column, int $number)
{
    $array = [];
    for ($x = 0; $x < $line; $x++) {
        for ($y = 0; $y < $column; $y++) {
            $array[$x][$y] = 0;
        }
    }

    for ($x = 0; $x < $line; $x++) {
        for ($y = 0; $y < $column; $y++) {
            for ($index = 0; $index < $number; $index++) {
                $array[$x][$y] += $a[$x][$index] * $b[$index][$y];
            }
        }
    }

    return $array;
}

/**
 * 矩阵快速幂
 *
 * @param array $matrix 矩阵
 * @param int $factorial 次方数
 */
function MatrixQuickPow(array $matrix, int $factorial)
{
    $multiplicand = $matrix;
    $result = [];
    $lenght = count($matrix);
    for ($line = 0; $line < $lenght; $line++) {
        for ($column = 0; $column < $lenght; $column++) {
            if ($line == $column) {
                $result[$line][$column] = 1;
            } else {
                $result[$line][$column] = 0;
            }
        }
    }

    while ($factorial) {
        if ($factorial & 1) {
            $result = MatrixMultiplication($result, $multiplicand, $lenght, $lenght, $lenght);
        }
        $multiplicand = MatrixMultiplication($multiplicand, $multiplicand, $lenght, $lenght, $lenght);
        $factorial = $factorial >> 1;
    }

    return $result;
}

/**
 * 矩阵快速幂求斐波那契数列
 *
 * @param int $number
 */
function FibonacciMatrixQuickPow(int $number)
{
    if ($number <= 0)
        return 0;
    if ($number <= 2)
        return 1;

    $multiplicand = [
        [1, 1],
        [1, 0]
    ];
    $result = [
        [1, 0],
        [0, 1]
    ];

    while ($number) {
        if ($number & 1) {
            $result = MatrixMultiplication($multiplicand, $result, 2, 2, 2);
        }
        $multiplicand = MatrixMultiplication($multiplicand, $multiplicand, 2, 2, 2);
        $number = $number >> 1;
    }

    return $result[0][1];
}

$number = (int) getopt('a:')['a'];

// $inside  = 10000;
$start = microtime(true);
// $i = $inside;
// while ($i--) {
FibonacciMatrixQuickPow($number);
// }
printf("Used %s S\n", microtime(true) - $start);
// dd(MatrixQuickPow(
//     [
//         [1, 1],
//         [1, 0]
//     ],
//     1000
// ));
// $start = microtime(true);
// $i = 100000;
// while ($i--) {
//     QuickPow(6, 12);
// }
// printf("Used %s S\n", microtime(true) - $start);
