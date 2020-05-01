<?php
class Solution
{

    /**
     * @param Integer $n
     * @return Boolean
     */
    function isHappy($n)
    {
        for ($i = 0; $i < 100; $i++) {
            $ans = 0;
            while ($n > 0) {
                $ans += ($n % 10) * ($n % 10);
                $n = floor($n / 10);
            }
            $n = $ans;
            if ($n == 1)
                return true;
        }
        return false;
    }

    public function isHappy1($n)
    {
        $fast = $n;
        $slow = $n;
        do {
            $slow = $this->squareSum($slow);
            $fast = $this->squareSum($fast);
            $fast = $this->squareSum($fast);
        } while ($slow != $fast);
        if ($fast == 1)
            return true;
        return false;
    }

    private function squareSum($m)
    {
        $squaresum = 0;
        while ($m != 0) {
            $squaresum += ($m % 10) * ($m % 10);
            $m = floor($m / 10);
        }
        return $squaresum;
    }
}

$en  = new Solution();
var_dump($en->isHappy(19));
