<?php

/**
 * 剑指 Offer 56 - I
 * 数组中只出现一次的数字
 * 
 * 题目描述
 * 一个整型数组里除了两个数字之外，其他的数字都出现了两次。请写程序找出这两个只出现一次的数字。
 */
function FindNumsAppearOnce($array)
{
    $temp = array_reduce($array, function ($carry, $item) {
        $carry ^= $item;
        return $carry;
    });
    $index = 0;
    while (($temp & 1) ==  0) {
        $temp >>= 1;
        $index += 1;
    }
    $num1 = $num2 = 0;
    foreach ($array as $value) {
        if (($value >> $index) & 1)
            $num1 ^= $value;
        else
            $num2 ^= $value;
    }

    return [$num1, $num2];
}
