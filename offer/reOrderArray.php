<?php

function reOrderArray($array)
{
    $lenght = count($array);
    //记录已经摆好位置的奇数的个数
    $oddNumber = 0;
    for ($i = 0; $i < $lenght; $i++) {
        if ($array[$i] & 1) {
            $j = $i;
            while ($j > $oddNumber) {
                $tmp = $array[$j];
                $array[$j] = $array[$j - 1];
                $array[$j - 1] = $tmp;
                $j--;
            }
            $oddNumber++;
        }
    }

    return $array;
}
