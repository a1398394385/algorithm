<?php

/**
 * 循环
 */
function Fibonacci(int $n)
{
    if ($n <= 0)
        return 0;
    if ($n <= 2)
        return 1;

    $one = $two = 1;
    for (; $n > 2; $n--) {
        $number = $one + $two;
        $one = $two;
        $two = $number;
    }

    return $number;
}

/**
 * 尾递归
 */
function Fibonacci1(int $n, $first = 1, $second = 1)
{
    if ($n <= 0)
        return 0;
    if ($n <= 2)
        return $second;

    return Fibonacci1($n - 1, $second, $first + $second);
}

/**
 * 动态规划
 */
function Fibonacci2(int $n)
{
    $f = 0;
    $g = 1;
    while (0 <= $n--) {
        $g += $f;
        $f = $g - $f;
    }

    return $f;
}


$number  = (int) getopt('a:')['a'];

$start = microtime(true);
// while ($i--) {
Fibonacci2($number);
// }
printf("Used %s S\n", microtime(true) - $start);

// $outside = 10;
// $inside  = 10000;
// while ($outside--) {
//     echo PHP_EOL;
//     $start = microtime(true);
//     $i = $inside;
//     while ($i--) {
//         Fibonacci($number);
//     }
//     printf("Used %s S\n", microtime(true) - $start);

//     $start = microtime(true);
//     $i = $inside;
//     while ($i--) {
//         Fibonacci1($number);
//     }
//     printf("Used %s S\n", microtime(true) - $start);

//     $start = microtime(true);
//     $i = $inside;
//     while ($i--) {
//         Fibonacci2($number);
//     }
//     printf("Used %s S\n", microtime(true) - $start);
// }
