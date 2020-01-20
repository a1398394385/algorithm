<?php

function ReverseSentence($str)
{
    if (strlen(trim($str)) > 0) {
        $str = explode(' ', $str);
        $str = array_reverse($str);
        $str = implode(' ', $str);
    }
    return $str;
}

function reverse(string &$str, int $start, int $end): void
{
    for (; $start < $end; $start++, $end--) {
        $str[$start] = $str[$start] ^ $str[$end];
        $str[$end]   = $str[$start] ^ $str[$end];
        $str[$start] = $str[$start] ^ $str[$end];
    }
}

function ReverseSentence1($str)
{
    $length = strlen(trim($str));
    if ($length > 0) {
        $str = trim($str);
        reverse($str, 0, $length - 1);
        $left = $right = 0;
        while ($right < $length) {
            for (; $right < $length && $str[$right] != ' '; $right++);
            reverse($str, $left, $right - 1);
            $right += 1;
            $left = $right;
        }
    }
    return $str;
}

$str = "student. a am I";
echo ReverseSentence1($str);
