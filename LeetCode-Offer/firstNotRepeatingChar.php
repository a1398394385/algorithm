<?php

/**
 * 题目描述
 * 在一个字符串(0<=字符串长度<=10000，全部由字母组成)中找到第一个只出现一次的字符,
 * 并返回它的位置, 如果没有则返回 -1（需要区分大小写）.
 */

/**
 * 在一个字符串中找到第一个只出现一次的字符
 *
 * @param string $str
 * @return int
 */
function FirstNotRepeatingChar($str)
{
    $array = [];
    $lenght = strlen($str);
    for ($i = 0; $i < $lenght; $i++) {
        $array[$str[$i]] = ($array[$str[$i]] ?? 0) + 1;
    }
    for ($i = 0; $i < $lenght; $i++) {
        if ($array[$str[$i]] == 1)
            return $i;
    }
    return -1;
}



// TODO:Test
$str = 'aabbccdffe';
$str = "";
var_dump(FirstNotRepeatingChar($str));
