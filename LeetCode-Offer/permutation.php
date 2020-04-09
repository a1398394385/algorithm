<?php

require '../vendor/autoload.php';

function Permutation($str)
{
    $length = strlen($str);
    if ($length <= 1)
        return $str == "" ? [] : [$str];
    $result = [];
    for ($i = 0, $temp = []; $i < $length; $i++) {
        $head = $str[$i];
        if (isset($temp[$head]))
            continue;
        $temp[$head] = 1;
        $tails = Permutation(substr($str, 0, $i) . substr($str, $i + 1));
        foreach ($tails as $tail) {
            $result[] = $head . $tail;
        }
    }
    return $result;
}



$str = '';
dd(Permutation($str));
