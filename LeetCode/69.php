<?php

class Solution
{
    private static $dp = [];

    /**
     * @param Integer $x
     * @return Integer
     */
    function mySqrt($x)
    {
        if ($x <= 1) return $x;
        $left = 0;
        $right = $x >> 1;
        while ($left < $right) {
            $mid = ($left + $right) >> 1;
            if (isset(static::$dp[$mid])) {
                $powMid = static::$dp[$mid];
            } else {
                $powMid = $mid * $mid;
                static::$dp[$mid] = $powMid;
            }
            if ($powMid == $x) return $mid;
            else if ($powMid > $x) $right = $mid - 1;
            else $left = $mid + 1;
        }
        return $right;
    }

    public function mySqrt1(int $x): int
    {
        if ($x <= 1) return $x;
        $r = $x;
        while ($r > floor($x / $r))
            $r = ($r + floor($x / $r)) >> 1;
        return $r;
    }

    public function mySqrt2(int $x): int
    {
        if ($x <= 1) return $x;
        $left = 0;
        $right = $x;
        while ($left < $right) {
            $mid = ($left + $right + 1) >> 1;
            if ((int) $mid * $mid > $x) {
                $right = $mid - 1;
            } else {
                $left = $mid;
            }
        }
        return $left;
    }
}

$en = new Solution();
echo $en->mySqrt(8);
echo $en->mySqrt(401);
echo $en->mySqrt(2501);
