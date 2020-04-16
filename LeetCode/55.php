<?php
class Solution
{

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function canJump($nums)
    {
        $count = count($nums);
        for ($i = 0; $i < $count - 1 && $count > 1;) {
            if ($nums[$i] == 0) return false;
            $jump = 1;
            for ($j = 1, $max = 0; $j <= $nums[$i]; $j++) {
                if ($j + $nums[$i + $j] > $max) {
                    $max = $j + $nums[$i + $j];
                    if ($max + $i >= $count - 1) return true;
                    $jump = $j;
                }
            }
            $i += $jump;
        }
        return true;
    }

    public function canJump1(array $nums): bool
    {
        $count = count($nums) - 1;
        for ($i = $count - 1; $i >= 0; $i--) {
            if ($i + $nums[$i] >= $count) $count = $i;
        }
        return $count === 0;
    }
}

$test = new Solution();
var_dump($test->canJump1([1, 1, 2, 2, 0, 1, 1]));
var_dump($test->canJump([3, 2, 1, 0, 4]));
