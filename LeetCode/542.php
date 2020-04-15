<?php
require_once '../vendor/autoload.php';
class Solution
{

    /**
     * @param Integer[][] $matrix
     * @return Integer[][]
     */
    function updateMatrix($matrix)
    {
        $X = count($matrix);
        $Y = count($matrix[0]);
        for ($flag = true; $flag == true;) {
            $flag = false;
            for ($x = 0; $x < $X; $x++) {
                for ($y = 0; $y < $Y; $y++) {
                    if ($matrix[$x][$y] != 0) {
                        $temp = $matrix[$x][$y];
                        $distance = PHP_INT_MAX;
                        $distance = min($distance, $matrix[$x - 1][$y] ?? PHP_INT_MAX);
                        $distance = min($distance, $matrix[$x + 1][$y] ?? PHP_INT_MAX);
                        $distance = min($distance, $matrix[$x][$y - 1] ?? PHP_INT_MAX);
                        $distance = min($distance, $matrix[$x][$y + 1] ?? PHP_INT_MAX);
                        $matrix[$x][$y] = 1 + $distance;
                        if ($temp != $matrix[$x][$y])
                            $flag = true;
                    }
                }
            }
            for ($x = $X - 1; $x >= 0; $x--) {
                for ($y = $Y - 1; $y >= 0; $y--) {
                    if ($matrix[$x][$y] != 0) {
                        $temp = $matrix[$x][$y];
                        $distance = PHP_INT_MAX;
                        $distance = min($distance, $matrix[$x - 1][$y] ?? PHP_INT_MAX);
                        $distance = min($distance, $matrix[$x + 1][$y] ?? PHP_INT_MAX);
                        $distance = min($distance, $matrix[$x][$y - 1] ?? PHP_INT_MAX);
                        $distance = min($distance, $matrix[$x][$y + 1] ?? PHP_INT_MAX);
                        $matrix[$x][$y] = 1 + $distance;
                        if ($temp != $matrix[$x][$y])
                            $flag = true;
                    }
                }
            }
        }
        return $matrix;
    }

    public function updateMatrix1(array $matrix)
    {
        $X = count($matrix);
        $Y = count($matrix[0]);
        for ($x = 0; $x < $X; $x++) {
            for ($y = 0; $y < $Y; $y++) {
                if ($matrix[$x][$y] == 1)
                    $matrix[$x][$y] = $X + $Y;
                if ($x > 0)
                    $matrix[$x][$y] = min($matrix[$x][$y], $matrix[$x - 1][$y] + 1);
                if ($y > 0)
                    $matrix[$x][$y] = min($matrix[$x][$y], $matrix[$x][$y - 1] + 1);
            }
        }
        for ($x = $X - 1; $x >= 0; $x--) {
            for ($y = $Y - 1; $y >= 0; $y--) {
                if ($matrix[$x][$y] != 0) {
                    if ($x < $X - 1)
                        $matrix[$x][$y] = min($matrix[$x][$y], $matrix[$x + 1][$y] + 1);
                    if ($y < $Y - 1)
                        $matrix[$x][$y] = min($matrix[$x][$y], $matrix[$x][$y + 1] + 1);
                }
            }
        }
    }

    public function updateMatrix2(array $matrix)
    {
        $X = count($matrix);
        $Y = count($matrix[0]);
        $queue = new \SplQueue();
        for ($x = 0; $x < $X; $x++) {
            for ($y = 0; $y < $Y; $y++) {
                if ($matrix[$x][$y] == 0)
                    $queue->enqueue([$x, $y]);
                else
                    $matrix[$x][$y] = $X + $Y;
            }
        }
        $array = [[0, 1], [0, -1], [1, 0], [-1, 0]];
        while ($queue->count()) {
            $temp = $queue->dequeue();
            foreach ($array as $value) {
                $x = $temp[0] + $value[0];
                $y = $temp[1] + $value[1];
                if (
                    $x >= 0 && $x < $X
                    && $y >= 0 && $y < $Y
                    && $matrix[$x][$y] > $matrix[$temp[0]][$temp[1]] + 1
                ) {
                    $matrix[$x][$y] = $matrix[$temp[0]][$temp[1]] + 1;
                    $queue->enqueue([$x, $y]);
                }
            }
        }
        return $matrix;
    }
}
