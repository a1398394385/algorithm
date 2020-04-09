<?php

class Solution
{

    /**
     * @param Integer[] $A
     * @return Integer
     */
    function minIncrementForUnique($A)
    {
        $map = array_fill(0, 40001, 0);
        $move = 0;
        foreach ($A as $value) {
            while ($map[$value] == 1) {
                $move++;
                $value++;
            }
            $map[$value] = 1;
        }
        return $move;
    }

    function minIncrementForUnique1($A)
    {
        $move = 0;
        sort($A);
        $count = count($A);
        for ($i = 1; $i < $count; $i++) {
            if ($A[$i] <= $A[$i - 1]) {
                $move += $A[$i - 1] + 1 - $A[$i];
                $A[$i] = $A[$i - 1] + 1;
            }
        }

        return $move;
    }
}



// test
$solution = new Solution;
$array = [1, 2, 2];
$array = [3, 2, 1, 2, 1, 7];
echo $solution->minIncrementForUnique1($array);
