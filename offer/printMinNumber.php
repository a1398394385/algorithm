<?php

/**
 * 题目描述
 * 输入一个正整数数组，把数组里所有数字拼接起来排成一个数，打印能拼接出的所有数字中最小的一个。
 * 例如输入数组{3，32，321}，则打印出这三个数字能排成的最小数字为321323。
 */
function PrintMinNumber($numbers)
{
    $lenght = array_reduce($numbers, function ($carry, $item) {
        $carry *= strlen($item);
        return $carry;
    }, 1);
    $numbers = array_combine($numbers, array_map(function ($value) use ($lenght) {
        return str_pad($value, $lenght, $value);
    }, $numbers));
    asort($numbers);
    $result = '';
    foreach ($numbers as $key => $value) {
        $result .= $key;
    }
    return $result;
}


// TODO:Test
$numbers = [3, 32, 321];
$numbers = [1, 11, 111];
var_dump(PrintMinNumber($numbers));
