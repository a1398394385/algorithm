<?php

function Power($base, $exponent)
{
    if ($exponent == 0)
        return 1;
    if ($base == 0)
        return 0;

    $result = 1;
    $isNegative = (0 <=> $exponent);
    $exponent = abs($exponent);
    while ($exponent) {
        if ($exponent & 1)
            $result *= $base;
        $base *= $base;
        $exponent = $exponent >> 1;
    }

    return $isNegative == 1 ? (1 / $result) : $result;
}

echo Power(3, -2);
