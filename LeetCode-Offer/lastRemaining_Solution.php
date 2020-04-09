<?php
class test
{
}

/**
 * 公式法解约瑟夫环
 * f(n) = (f(n - 1) + m) % n
 * @param int $n
 * @param int $m
 * @return int
 */
function LastRemaining_Solution($n, $m)
{
    if ($n == 0)
        return -1;
    if ($n == 1)
        return 0;
    else
        return (LastRemaining_Solution($n - 1, $m) + $m) % $n;
}

function LastRemaining_Solution1($n, $m)
{
    if ($n == 0 || $m == 0)
        return -1;
    $numbers = [];
    for ($i = 0; $i < $n; $i++) {
        $numbers[$i] = $i + 1;
    }
    $numbers[$n - 1] = 0;
    $index = 0;
    while ($numbers[$index] != $index) {
        for ($i = 2; $i < $m; $i++)
            $index = $numbers[$index];
        $index = $numbers[$index] = $numbers[$numbers[$index]];
    }
    return $index;
}
