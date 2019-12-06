<?php

$result = 0;

function jumpFloor(int $number)
{
    global $result;
    if ($number == 0) {
        $result += 1;
        return;
    }

    if ($number >= 1) {
        jumpFloor($number - 1);
        if ($number >= 2) {
            jumpFloor($number - 2);
        }
    }

    return $result;
}

function jumpFloor2(int $number)
{
    if ($number <= 2)
        return $number;

    return jumpFloor2($number - 1) + jumpFloor2($number - 2);
}

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

function jumpFloor3(int $number)
{
    if ($number <= 2)
        return $number;

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

    return $result[0][0];
}

function jumpFloor4(int $number)
{
    if ($number <= 2)
        return $number;

    $f = 2;
    $g = 3;
    while (3 <= $number--) {
        $g += $f;
        $f = $g - $f;
    }

    return $f;
}


// TODO: TEST

$number  = (int) getopt('a:')['a'];

$start = microtime(true);
while ($number--) {
    jumpFloor3($number);
}
printf("Used %s S\n", microtime(true) - $start);
