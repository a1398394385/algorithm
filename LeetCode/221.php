<?php

class Solution
{

    /**
     * @param String[][] $matrix
     * @return Integer
     */
    function maximalSquare($matrix)
    {
        $rows = count($matrix);
        $lines = count($matrix[0]);
        $result = 0;
        for ($i = 0; $i < $rows && $rows - $i > $result; $i++) {
            for ($j = 0; $j < $lines && $lines - $j > $result; $j++) {
                $queue = $temp = [];
                if ((int) $matrix[$i][$j] == 1) {
                    $temp[$i][$j] = $max = 1;
                    $queue[] = [$i, $j];
                    while (count($queue) > 0) {
                        list($row, $line) = array_shift($queue);
                        if ($row == $rows - 1 || $line == $lines - 1) break;
                        $right = isset($temp[$row + 1][$line]) ? $temp[$row + 1][$line] : (int) $matrix[$row + 1][$line];
                        $under = isset($temp[$row][$line + 1]) ? $temp[$row][$line + 1] : (int) $matrix[$row][$line + 1];
                        $last  = isset($temp[$row + 1][$line + 1]) ? $temp[$row + 1][$line + 1] : (int) $matrix[$row + 1][$line + 1];
                        if ($right == 0 || $under == 0 || $last == 0)
                            break;
                        $last = ($right < $under ? $right : $under) + 1;
                        $max = $max > $last ? $max : $last;
                        if (!isset($temp[$row + 1][$line])) {
                            $temp[$row + 1][$line] = $right;
                            $queue[] = [$row + 1, $line];
                        }
                        if (!isset($temp[$row][$line + 1])) {
                            $temp[$row][$line + 1] = $under;
                            $queue[] = [$row, $line + 1];
                        }
                        if (!isset($temp[$row + 1][$line + 1])) {
                            $temp[$row + 1][$line + 1] = $last;
                            $queue[] = [$row + 1, $line + 1];
                        }
                    }
                }
                $result = $result > $max ? $result : $max;
            }
        }
        return $result * $result;
    }

    function maximalSquare1($matrix)
    {
        $rows = count($matrix);
        if (empty($rows)) return 0;
        $cols = count($matrix[0]);
        if (empty($cols)) return 0;

        $dp = [];
        $maxLen = 0;

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($i == 0 || $j == 0 || $matrix[$i][$j] == 0)
                    $dp[$i][$j] = $matrix[$i][$j];
                else
                    $dp[$i][$j] = min($dp[$i][$j - 1], $dp[$i - 1][$j], $dp[$i - 1][$j - 1]) + 1;

                if ($maxLen < $dp[$i][$j])
                    $maxLen = $dp[$i][$j];
            }
        }

        return $maxLen * $maxLen;
    }
}
/* 
1 1 1 1 1
1 2 2 2 2
1 2 3 3 3
1 2 3 4 4
1 2 3 4 5
 */

$matrix = [
    ["1", "0", "1", "0", "0"],
    ["1", "0", "1", "1", "1"],
    ["1", "1", "1", "1", "1"],
    ["1", "0", "1", "1", "1"]
];
$matrix = [
    [1, 1, 1, 1, 1],
    [1, 1, 1, 1, 1],
    [1, 1, 1, 1, 1],
    [1, 1, 1, 1, 1],
    [1, 1, 1, 1, 1]
];
$en = new Solution();
var_dump($en->maximalSquare($matrix));
