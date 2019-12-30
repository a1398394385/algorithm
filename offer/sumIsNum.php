<?php

/*
题目描述
读入一个有n个数的递增整形数组，并给出一个和值sum，判断是否存在两个数字使得它们的和为sum
输入描述:

输入数据包括两行:
 第一行两个整数n(1 ≤ n ≤ 10 ^ 5),sum(1 ≤ sum ≤ 10 ^ 9)
 第二行n个整数,范围均在32位整数内,以空格分隔

输出描述:
如果找到和值为某值的两个数，输出两个数字的下标(数组下标从0开始),
如果有多解,输出第一个数下标最小的那个解;否则输出false

example:
input:  6 9
        2 3 5 6 7 10
output: 0 4
*/


function sumIsNum(array $array, int $sum): string
{
    $count = count($array) - 1;
    $half = $sum >> 1;
    for ($l = 0; $l < $count && $array[$l] <= $half; $l++) {
        for ($r = $count; $r >= 0 && $array[$r] >= $half; $r--) {
            if ($array[$l] + $array[$r] == $sum)
                return "$l $r";
            if ($array[$l] + $array[$r] > $sum) {
                unset($array[$r]);
                $count -= 1;
            }
        }
    }

    return 'false';
}


$array = [1, 2, 3, 5];
$sum = 8;
list($n, $sum) = fscanf(STDIN, '%d%d');
$array = fscanf(STDIN, str_repeat('%d', $n));
echo sumIsNum($array, $sum);
