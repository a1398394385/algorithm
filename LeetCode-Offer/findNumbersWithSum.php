<?php

function FindNumbersWithSum($array, $sum)
{
    $left = 0;
    $right = count($array) - 1;
    while ($left < $right) {
        $cur = $array[$left] + $array[$right];
        switch ($cur <=> $sum) {
            case 0:
                return [$array[$left], $array[$right]];
            case -1:
                $left++;
                break;
            case 1:
                $right--;
                break;
        }
    }
    return [];
}
