<?php

function rectCover($number)
{
    $result = 0;
    if ($number == 0)
        return 1;

    if ($number >= 1) {
        if ($number >= 2) {
            $result += rectCover($number - 2);
        }
        $result += rectCover($number - 1);
    }

    return $result;
}

function rectCover2(int $number)
{
    if ($number <= 2)
        return $number;

    $f = 2;
    $g = 3;
    while ($number-- > 2) {
        $g += $f;
        $f = $g - $f;
    }

    return $f;
}


// TODO: TEST

$number  = (int) getopt('a:')['a'];

$start = microtime(true);
// while ($number--) {
echo rectCover2($number);
// }
printf("   Used %s S\n", microtime(true) - $start);
