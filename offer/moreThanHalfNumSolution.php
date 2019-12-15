<?php

/**
 * 题目描述
 * 数组中有一个数字出现的次数超过数组长度的一半，请找出这个数字
 * 例如输入一个长度为9的数组{1,2,3,2,2,2,5,4,2}
 * 由于数字2在数组中出现了5次，超过数组长度的一半，因此输出2
 * 如果不存在则输出0
 */


function MoreThanHalfNum_Solution($numbers)
{
    $count = floor(count($numbers) / 2);
    $numbers = array_count_values($numbers);
    foreach ($numbers as $key => $number) {
        if ($number >= $count + 1) {
            return $key;
        }
    }
    return 0;
}


function MoreThanHalfNum_Solution1($numbers)
{
    $count = 0;
    $number = 0;
    $lenght = count($numbers);
    for ($i = 0; $i < $lenght; $i++) {
        if ($count == 0)
            $number = $numbers[$i];
        if ($numbers[$i] == $number)
            $count += 1;
        else
            $count -= 1;
    }
    if ($count)
        for ($count = 0, $i = 0; $i < $lenght; $i++)
            if ($numbers[$i] == $number)
                $count += 1;
    if ($count >= floor($lenght / 2) + 1)
        return $number;
    return 0;
}



// TODO:Test
$arr = [1, 2, 3, 2, 2, 2, 5, 4, 2];
$arr = [4, 2, 1, 4, 2, 4];
$arr = [];
$arr = [1, 2, 3, 2, 4, 2, 5, 2, 3];
var_dump(MoreThanHalfNum_Solution1($arr));
