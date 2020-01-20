<?php

function IsContinuous($numbers)
{
    $count = count($numbers);
    if ($count == 5) {
        sort($numbers);
        $min = PHP_INT_MAX;
        $max = PHP_INT_MIN;
        for ($i = 0; $i < $count; $i++) {
            if ($numbers[$i] != 0) {
                if ($numbers[$i] == $numbers[$i - 1])
                    return false;
                $min = min($min, $numbers[$i]);
                $max = max($max, $numbers[$i]);
            }
        }
        return ($max - $min) < 5;
    }
    return false;
}
