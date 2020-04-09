<?php

function movingCount($threshold, $rows, $cols)
{
    $result = 0;
    $capX = $threshold > 8 ? ($threshold - 7) * 10 : 10;
    for ($i = 0; $i < $rows && $i < $capX; $i++) {
        $temp = sum($i);
        $capY = $capX - floor($i / 10) * 10;
        for ($j = 0; $j < $cols && $j < $capY; $j++) {
            if ($temp + sum($j) <= $threshold)
                $result += 1;
        }
    }
    return $result;
}


function movingCount1($threshold, $rows, $cols)
{
    $flag = array_fill(0, $rows, array_fill(0, $cols, 0));
    return helper(0, 0, $rows, $cols, $flag, $threshold);
}

function helper(int $i, int $j, int $rows, int $cols, array &$flag, int $threshold)
{
    if ($i >= $rows || $j >= $cols || sum($i) + sum($j) > $threshold || $flag[$i][$j] == 1)
        return 0;
    $flag[$i][$j] = 1;
    return helper($i + 1, $j, $rows, $cols, $flag, $threshold)
        + helper($i, $j + 1, $rows, $cols, $flag, $threshold)
        + 1;
}

function sum($num)
{
    $result = 0;
    while ($num) {
        $result += $num % 10;
        $num = floor($num / 10);
    }
    return $result;
}

// TODO: test
$i = 1;
$rows = 10000;
$cols = 10000;
$threshold = 1;
while ($i <= 10 && $i++) {
    $start = microtime(true);
    echo movingCount($threshold, $rows, $cols) . '  ';
    printf("Used %sS\n", microtime(true) - $start);

    $start = microtime(true);
    echo movingCount1($threshold, $rows, $cols) . '  ';
    printf("Used %sS\n", microtime(true) - $start);

    echo PHP_EOL;
}
