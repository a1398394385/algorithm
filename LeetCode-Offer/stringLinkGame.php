<?php

/**
 * 题目描述
 * 对于输入的字符串，从左到右扫描字符串，
 * 如果存在由三个以上（包括三个）连续相同字符组成的子串，
 * 就将这个子串从原串中去掉，并将原有字符串剩下的部分拼接到一起。
 * 重复上述过程，直到无法去掉任何子串
 *
 * example:
 * input:  AAABCCDDDCB
 * output: BB
 */

/**
 * 字符串连连看
 *
 * @param string $str
 * @return string
 */
function StringLinkGame($str)
{
    $lenght = strlen($str);
    $result = $str;
    for ($i = 0; $i < $lenght; $i++) {
        $result = implode(explode(str_repeat($str[$i], 3), $result));
    }
    return $result;
}


// TODO:Test
$str = trim('AAABCCDDDCB');
// var_dump(StringLinkGame($str));
$str = fread(STDIN, 10000);
echo StringLinkGame($str);
