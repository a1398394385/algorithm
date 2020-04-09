<?php

function isNumeric($str)
{
    $matches = [];
    preg_match('/^[+-]?([0-9]+)?((\.[0-9]+)?([eE][+-]?[0-9]+)?)?$/', $str, $matches);

    return !empty($matches[0]);
}

$index = 0;
function isNumeric1($str)
{
    global $index;
    $length = strlen($str);
    if ($length < 1)
        return false;

    $flag = scanInteger($str);
    if ($index < $length && $str[$index] == '.') {
        $index++;
        $flag = scanUnsignedInteger($str) || $flag;
    }

    if ($index < $length && ($str[$index] == 'E' || $str[$index] == 'e')) {
        $index++;
        $flag = $flag && scanInteger($str);
    }

    return $flag && ($index == $length);
}

function scanInteger(string $str): bool
{
    global $index;
    $length = strlen($str);
    if ($index < $length && ($str[$index] == '+' || $str[$index] == '-'))
        $index++;
    return scanUnsignedInteger($str);
}

function scanUnsignedInteger(string $str): bool
{
    global $index;
    $start = $index;
    $length = strlen($str);
    while ($index < $length && $str[$index] >= '0' && $str[$index] <= '9')
        $index++;
    return $start < $index;
}

function isNumeric2($str)
{
    $arr = "+-n.ne+-n";
    $turn = [
        //+  -  n  .  n  e  +  -  n
        [1, 1, 1, 0, 0, 0, 0, 0, 0], // # start
        [0, 0, 1, 1, 0, 0, 0, 0, 0], // +
        [0, 0, 1, 1, 0, 0, 0, 0, 0], // -
        [0, 0, 1, 1, 0, 1, 0, 0, 0], // n
        [0, 0, 0, 0, 1, 0, 0, 0, 0], // .
        [0, 0, 0, 0, 1, 1, 0, 0, 0], // n
        [0, 0, 0, 0, 0, 0, 1, 1, 1], // e
        [0, 0, 0, 0, 0, 0, 0, 0, 1], // +
        [0, 0, 0, 0, 0, 0, 0, 0, 1], // -
        [0, 0, 0, 0, 0, 0, 0, 0, 1]  // n
    ];
    $cur = 0;
    for ($i = 0; isset($str[$i]); $i++) {
        for ($j = 0; $j < 9; $j++) {
            if ($turn[$cur][$j]) {
                if (('0' <= $str[$i] && $str[$i] <= '9' && $arr[$j] == 'n') ||
                    ($str[$i] == 'E' && $arr[$j] == 'e') ||
                    $str[$i] == $arr[$j]
                ) {
                    $cur = $j + 1;
                    break;
                }
            }
        }
        if ($j == 9)
            return false;
    }
    if ($cur == 3 || $cur == 4 || $cur == 5 || $cur == 9)
        return true;
    return false;
}

$str = "-1E-16";
$i = 1;
var_dump(isNumeric2($str));
