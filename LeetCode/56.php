<?php
class Solution
{

    /**
     * @param Integer[][] $intervals
     * @return Integer[][]
     */
    function merge($intervals)
    {
        $count = count($intervals);
        $this->QuickSort($intervals, 0, $count - 1);
        for ($i = 0, $j = 1; $j < $count;) {
            if ($intervals[$i][0] <= $intervals[$j][0] && $intervals[$i][1] >= $intervals[$j][0]) {
                $intervals[$i][1] = max($intervals[$i][1], $intervals[$j][1]);
                unset($intervals[$j++]);
            } else {
                $i = $j++;
            }
        }
        return $intervals;
    }

    public function QuickSort(array &$array, int $left, int $right): void
    {
        if ($left >= $right) return;

        $l = $left;
        $r = $right;
        $pivot = $array[$l];
        while ($l < $r) {
            for (; $l < $r && $array[$r][0] >= $pivot[0]; $r--);
            if ($l < $r)
                $array[$l++] = $array[$r];
            for (; $l < $r && $array[$l][0] <= $pivot[0]; $l++);
            if ($l < $r)
                $array[$r--] = $array[$l];
        }
        $array[$l] = $pivot;
        $this->QuickSort($array, $left, $l - 1);
        $this->QuickSort($array, $l + 1, $right);
    }
}


$nums = [[2, 6], [1, 3], [8, 10], [15, 18]];
$test = new Solution();
var_dump($test->merge($nums));
