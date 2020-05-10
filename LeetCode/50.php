<?php
class Solution
{

    /**
     * @param Float $x
     * @param Integer $n
     * @return Float
     */
    function myPow($x, $n)
    {
        if ($n < 0) return 1 / $this->myPow($x, -$n);
        $res = $x;
        $ans = 1;
        while ($n) {
            if ($n & 1) {
                $ans *= $res;
            }
            $res *= $res;
            $n = $n >> 1;
        }
        return $ans;
    }

    function myPow1($x, $n)
    {
        if ($n == 0)
            return 1;
        if ($n < 0)
            return 1 / $this->myPow1($x, -$n);
        $mid = $this->myPow1($x, $n >> 1);
        if ($n & 1)
            return $mid * $mid * $x;
        return $mid * $mid;
    }
}
