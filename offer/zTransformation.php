<?php

require '../vendor/autoload.php';

/*
 * LEETCODEISHIRING
 *
 * L   C   I   R
 * E T O E S I I G
 * E   D   H   N
 *
 * 0   4   8    12
 * 1 3 5 7 9 11 13 15
 * 2   6   10   14
 *
 * 0   1   2    3
 * 4   5   6    7
 * 8   9   10   11
 *
 * ==================
 *
 * L     D     R
 * E   O E   I I
 * E C   I H   N
 * T     S     G
 *
 * 0     6      12
 * 1   5 7   11 13
 * 2 4   8 10   14
 * 3     9      15
 *
 * 0     1      2
 * 3     4      5
 * 6     7      8
 * 9     10     11
 */
function ZTransformation(string $str, int $number = 0)
{
    $str = str_split($str);
    $count = count($str);
    $result = [];
    for ($i = $number - 3; $i >= 0; $i--) {
        for ($index = $i + $number; $index < $count; $index += (($number - 1) * 2)) {
            $str[$index - (($i + 1) * 2)] .= $str[$index];
            unset($str[$index]);
        }
    }

    $divisor = ($number - 1) * 2;
    foreach ($str as $key => $value) {
        $num1 = floor($key / $divisor);
        $num2 = fmod($key, $divisor);
        $result[$num1 + ($num2 * $divisor)] = $value;
    }
    ksort($result);
    $result = implode('', $result);
    return $result;
}


// TODO:Test
$str = 'LEETCODEISHIRING';
$str = 'LEETCODEISHIRINGA';
dd(ZTransformation($str, 3));
