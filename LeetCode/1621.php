<?php
class Solution
{

    /**
     * @param Integer[][] $matrix
     * @return Integer[]
     */
    function spiralOrder($matrix)
    {
        $count = count($matrix, 1);
        // $count = array_reduce($matrix, function ($carry, $item) {
        //     $carry += count($item);
        //     return $carry;
        // });
        $array = [];
        $y = 0;
        $x = -1;
        $yS = 1;
        $xS = 1;
        for (
            $Y = count($matrix) - 1, $X = count($matrix[0]);
            count($array) < $count;
            $X--, $Y--, $xS = -$xS, $yS = -$yS
        ) {
            for ($i = 0; $i < $X; $i++) {
                $x += $xS;
                $array[] = $matrix[$y][$x];
            }
            for ($i = 0; $i < $Y; $i++) {
                $y += $yS;
                $array[] = $matrix[$y][$x];
            }
        }
        return $array;
    }
}
