<?php

function multiply($numbers)
{
    $count = count($numbers);
    if ($count > 0) {
        $result[0] = 1;
        for ($i = 1; $i < $count; $i++) {
            $result[$i] = $result[$i - 1] * $numbers[$i - 1];
        }
        for ($temp = 1, $i = $count - 2; $i >= 0; $i--) {
            $temp *= $numbers[$i + 1];
            $result[$i] *= $temp;
        }
    }
    return $result;
}
