<?php
class Solution
{
    public function intersection(array $start1, array $end1, array $start2, array $end2): array
    {
        $intersect = $this->intersect($start1, $end1, $start2, $end2);
        if ($intersect == [])
            return [];
        list($slope1, $C1, $slope2, $C2) = $intersect;
        if ($slope2 == $slope1) {
            if ($start1[0] == $end1[0] && $end1[0] == $start2[0] && $start2[0] == $end2[0]) {
                $y = max(min($start1[1], $end1[1]), min($start2[1], $end2[1]));
                return [$start1[0], $y];
            }
            $x = max(min($start1[0], $end1[0]), min($start2[0], $end2[0]));
            return [$x, $x * $slope1 + $C1];
        }
        $low = min($start1[0], $end1[0]);
        $high = max($start1[0], $end1[0]);
        while (1) {
            $mid = ($high + $low) / 2;
            $y1 = ($mid * $slope1 + $C1);
            $y2 = ($mid * $slope2 + $C2);
            // switch (($mid * $slope1 + $C1) <=> ($mid * $slope2 + $C2)) {
            switch ($y1 <=> $y2) {
                case 1:
                    $low = $mid;
                    break;
                case -1:
                    $high = $mid;
                    break;
                case 0:
                    return [$mid, $mid * $slope1 + $C1];
            }
        }
        return [];
    }

    public function intersect(array $start1, array $end1, array $start2, array $end2): array
    {
        $intersect = [];

        if (($end1[0] - $start1[0] < 0) == ($end2[0] - $start2[0] >= 0) || ($end1[1] - $start1[1] < 0) == ($end2[1] - $start2[1] >= 0))
            $this->swap($start1, $end1);
        $intersectX = (($end1[0] >= $start2[0]) == ($end2[0] >= $start1[0]) || ($end1[0] <= $start2[0]) == ($end2[0] <= $start1[0]));
        $intersectY = (($end1[1] >= $start2[1]) == ($end2[1] >= $start1[1]) || ($end1[1] <= $start2[1]) == ($end2[1] <= $start1[1]));
        if ($intersectX && $intersectY) {
            $slope1 = ($end1[0] - $start1[0]) != 0 ? ($end1[1] - $start1[1]) / ($end1[0] - $start1[0]) : 0;
            $slope2 = ($end2[0] - $start2[0]) != 0 ? ($end2[1] - $start2[1]) / ($end2[0] - $start2[0]) : 0;
            $C1Start = $start1[1] - ($slope1 * $start1[0]);
            $C1End = $end1[1] - ($slope1 * $end1[0]);
            $C1 = $C1Start == $C1End ? $C1Start : 0;
            $C2Start = $start2[1] - ($slope2 * $start2[0]);
            $C2End = $end2[1] - ($slope2 * $end2[0]);
            $C2 = $C2Start == $C2End ? $C2Start : 0;
            if ($slope1 != $slope2 || $C1 == $C2) {
                if ($slope2 > $slope1) {
                    $this->swap($slope1, $slope2);
                    $this->swap($C1, $C2);
                }
                $intersect = [$slope1, $C1, $slope2, $C2];
            }
        }
        return $intersect;
    }

    public function swap(&$value1, &$value2): void
    {
        $temp = $value1;
        $value1 = $value2;
        $value2 = $temp;
    }
}

$test = new Solution();
// var_dump($test->intersection([0, 0], [1, 0], [1, 1], [0, -1]));     // [0.5, 0]
// var_dump($test->intersection([0, 0], [3, 3], [1, 1], [2, 2]));      // [1.0, 1.0]
// var_dump($test->intersection([0, 0], [1, 1], [1, 0], [2, 1]));      // []
// var_dump($test->intersection([0, 3], [0, 6], [0, 1], [0, 5]));      // [0.0, 3.0];
// var_dump($test->intersection([0, 0], [0, 1], [0, 0], [0, -1]));     // [0.0, 0.0]
// var_dump($test->intersection([0, 0], [1, -1], [0, 0], [-1, 1]));    // [0.0, 0.0]
// var_dump($test->intersection([0, 0], [1, 1], [2, 2], [3, 3]));      // []
var_dump($test->intersection([1, 0], [1, 1], [-1, 0], [3, 2]));      // []
