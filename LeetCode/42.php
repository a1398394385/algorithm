<?php
class Solution
{

    /**
     * @param Integer[] $height
     * @return Integer
     */
    public static function trap($height)
    {
        $count = count($height);
        $result = 0;
        $stack = new \SplStack();
        for ($index = 0; $index < $count; $index++) {
            $min = $stack->count() == 0 ? PHP_INT_MAX : $stack->top()[0];
            if ($height[$index] == $min) {
                $stack->pop();
                $stack->push([$height[$index], $index]);
            } else if ($height[$index] < $min) {
                $stack->push([$height[$index], $index]);
            } else {
                while (1) {
                    $min = $stack->pop()[0];
                    if ($stack->count() == 0) {
                        $stack->push([$height[$index], $index]);
                        break;
                    }
                    $last = $stack->top();
                    if ($height[$index] > $last[0]) {
                        $result += ($last[0] - $min) * ($index - $last[1] - 1);
                    } else {
                        $result += ($height[$index] - $min) * ($index - $last[1] - 1);
                        if ($height[$index] == $last[0]) $stack->pop();
                        $stack->push([$height[$index], $index]);
                        break;
                    }
                }
            }
        }
        return $result;
    }

    public static function trap1(array $height)
    {
        $count = count($height);

        $left = $right = array_fill(0, $count, 0);
        for ($i = 1; $i < $count; $i++)
            $left[$i] = $left[$i - 1] > $height[$i - 1] ? $left[$i - 1] : $height[$i - 1];
        for ($i = $count - 2; $i >= 0; $i--)
            $right[$i] = $right[$i + 1] > $height[$i + 1] ? $right[$i + 1] : $height[$i + 1];

        $result = 0;
        for ($i = 0; $i < $count; $i++) {
            $min = $left[$i] < $right[$i] ? $left[$i] : $right[$i];
            $result += $min - $height[$i] > 0 ? $min - $height[$i] : 0;
        }
        return $result;
    }
}

$height = [0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1];
var_dump(Solution::trap1($height));
$height = [4, 2, 3];
var_dump(Solution::trap1($height));
$height = [3, 2, 4];
var_dump(Solution::trap1($height));
$height = [];
var_dump(Solution::trap1($height));
$height = [1, 1, 1, 1, 1];
var_dump(Solution::trap1($height));
$height = [5, 2, 1, 2, 1, 5];
var_dump(Solution::trap1($height));
$height = [5, 5, 1, 7, 1, 1, 5, 2, 7, 6];
var_dump(Solution::trap1($height));
