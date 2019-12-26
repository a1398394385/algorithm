<?php

/**
 * 题目描述
 * 输入一组未排序的整数，找出其中最长的连续数字的长度。
 * 例如输入为[3,1,2,5,7,4,8,9] ，其中连续的数据为1,2,3,4,5，长度为5 。
 * 要求算法时间复杂度为O(n).本题会人工判卷,请严格按照复杂度完成算法
 * @link https://www.nowcoder.com/practice/ec7770f3a4324ded8e105c0054af066b
 */
function findContinuousNumberInArray($array)
{
    $count = $result = $max = $min = 0;
    $bitmap = new SplFixedArray(65535);
    foreach ($array as $value) {
        $bitmap[$value] = 1;
        $max = max($max, $value);
        $min = min($min, $value);
    }
    for ($i = $min; $i <= $max; $i++, $count++) {
        if (!$bitmap[$i])
            $count = 0;
        $result = max($count, $result);
    }
    return $result;
}

// TODO:Test
$input = fread(STDIN, 10000);
$input = substr($input, 1, -2);
$array = explode(',', $input);
$array = array_map(function ($value) {
    return (int) $value;
}, $array);
echo findContinuousNumberInArray($array);
