<?php
/* 题目描述
请实现一个函数，将一个字符串中的每个空格替换成 '%20'
例如，当字符串为 'We Are Happy'
则经过替换之后的字符串为 'We%20Are%20Happy' */

function replaceSpace($str)
{
    $strArr = str_split($str);
    $returnStr = '';
    foreach ($strArr as $value) {
        if ($value == ' ')
            $returnStr .= '%20';
        else
            $returnStr .= $value;
    }

    echo $returnStr;
}

$str = 'We Are Happy';
replaceSpace($str);
