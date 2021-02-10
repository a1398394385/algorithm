<?php

function NumberOf1($n)
{
    $count = 0;
    if ($n < 0) {
        $n = abs($n) + 1;
    }
    while ($n) {
        $count += 1;
        $n = $n & ($n - 1);
    }

    return $count;
}

function NumberOf12(int $n)
{
    $count = 0;
    if ($n < 0) {
        $n = $n & 0x7FFFFFFF;
        ++$count;
    }
    while ($n != 0) {
        $count += $n & 1;
        $n = $n >> 1;
    }
    return $count;
}

function NumberOf13($n)
{
    $count = 0;
    for ($i = 0; $i < 32; $i++) {
        if (($n >> $i) & 1) {
            $count++;
        }
    }
    return $count;
}

// TODO: TEST
$number  = (int) getopt('a:')['a'];
echo NumberOf1(-16);
