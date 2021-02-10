<?php

/**
 * 题目描述
 * 输入一组未排序的整数，其中一个数字只出现一次，剩下的所有数字都出现了三次。
 * 找出这个只出现一次的数字。
 * 例如输入: [1,2,2,2,3,3,3]，输出为1
 */
function findUniqueNumberOfArray($array)
{
    $result = 0;
    $bitmap = array_fill(0, 32, 0);
    foreach ($array as $value) {
        $index = 31;
        while ($value) {
            $bitmap[$index--] += $value & 1;
            $value = $value >> 1;
        }
    }
    foreach ($bitmap as $value)
        $result = ($result << 1) + $value % 3;
    return $result;
}



// TODO:Test
$array = [1, 2, 2, 2, 3, 3, 3];
echo findUniqueNumberOfArray($array);
