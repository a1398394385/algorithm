<?php

class Solution
{

    /**
     * @param Integer[][] $matrix
     * @return NULL
     */
    function rotate(&$matrix)
    {
        $count = count($matrix);
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $matrix[$i][$j] = $matrix[$i][$j] ^ $matrix[$j][$i];
                $matrix[$j][$i] = $matrix[$i][$j] ^ $matrix[$j][$i];
                $matrix[$i][$j] = $matrix[$i][$j] ^ $matrix[$j][$i];
            }
        }
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < ($count >> 1); $j++) {
                $matrix[$i][$j] = $matrix[$i][$j] ^ $matrix[$i][$count - 1 - $j];
                $matrix[$i][$count - 1 - $j] = $matrix[$i][$j] ^ $matrix[$i][$count - 1 - $j];
                $matrix[$i][$j] = $matrix[$i][$j] ^ $matrix[$i][$count - 1 - $j];
            }
        }
    }
}
