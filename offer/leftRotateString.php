<?php

function reverse(string &$str, int $start, int $end): void
{
    for (; $start < $end; $start++, $end--) {
        $str[$start] = $str[$start] ^ $str[$end];
        $str[$end]   = $str[$start] ^ $str[$end];
        $str[$start] = $str[$start] ^ $str[$end];
    }
}

function LeftRotateString($str, $n)
{
    $length = strlen($str);
    if ($length > 0) {
        $n %= $length;
        reverse($str, 0, $length - 1);
        reverse($str, 0, $length - $n - 1);
        reverse($str, $length - $n, $length - 1);
    }
    return $str;
}
