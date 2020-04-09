<?php

function InversePairs($data)
{
    return name($data, 0, count($data) - 1);
}

function name(array &$numbers, int $start, int $end)
{
    if ($end - $start < 1)
        return 0;
    $result = 0;
    $mid = ($start + $end) >> 1;
    $result += name($numbers, $start, $mid) + name($numbers, $mid + 1, $end);
    $temp = [];
    for ($p1 = $mid, $p2 = $end; $p1 >= $start && $p2 > $mid;) {
        if ($numbers[$p1] > $numbers[$p2]) {
            $result += $p2 - $mid;
            array_unshift($temp, $numbers[$p1--]);
        } else {
            array_unshift($temp, $numbers[$p2--]);
        }
    }
    while ($p1 >= $start)
        array_unshift($temp, $numbers[$p1--]);
    while ($p2 > $mid)
        array_unshift($temp, $numbers[$p2--]);
    for ($i = $start; $i <= $end; $i++)
        $numbers[$i] = array_shift($temp);
    return $result;
}

$array = [364, 637, 341, 406, 747, 995, 234, 971, 571, 219, 993, 407, 416, 366, 315, 301, 601, 650, 418, 355, 460, 505, 360, 965, 516, 648, 727, 667, 465, 849, 455, 181, 486, 149, 588, 233, 144, 174, 557, 67, 746, 550, 474, 162, 268, 142, 463, 221, 882, 576, 604, 739, 288, 569, 256, 936, 275, 401, 497, 82, 935, 983, 583, 523, 697, 478, 147, 795, 380, 973, 958, 115, 773, 870, 259, 655, 446, 863, 735, 784, 3, 671, 433, 630, 425, 930, 64, 266, 235, 187, 284, 665, 874, 80, 45, 848, 38, 811, 267, 575];
// $array = [1, 2, 3, 4, 5, 6, 7, 0];
echo InversePairs($array);
