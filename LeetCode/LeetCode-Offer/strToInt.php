<?php

function StrToInt($str)
{
    $array = array_flip(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']);
    $length = strlen($str);
    if ($length == 0)
        return 0;
    if ($length == 1)
        if (!array_key_exists($str[0], $array))
            return 0;

    $sum = $index = 0;
    $label = 1;
    if (!array_key_exists($str[0], $array)) {
        $index = 1;
        if ($str[0] == '+')
            $label = 1;
        else if ($str[0] == '-')
            $label = -1;
        else
            return 0;
    }
    for (; $index < $length; $index++) {
        if (!array_key_exists($str[$index], $array))
            return 0;
        $sum = $sum * 10 + $array[$str[$index]];
    }
    $result = $sum * $label;
    if ($result > 2147483647 || $result < -2147483648)
        return 0;

    return $result;
}
// var_dump(StrToInt('123'));
