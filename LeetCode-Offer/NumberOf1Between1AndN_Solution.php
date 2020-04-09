<?php

function NumberOf1Between1AndN_Solution($n)
{
    $result = 0;
    for ($i = 1; $i <= $n; $i *= 10) {
        $a = floor($n / $i);
        $b = $n % $i;
        $result = $result + floor(($a + 8) / 10) * $i + ($a % 10 == 1) * ($b + 1);
    }
    return $result;
}
