<?php

class Solution
{
    public static function waysToChange($n)
    {
        $dp = array_fill(0, $n + 1, 0);
        $dp[0] = 1;
        $coins = [25, 10, 5, 1];
        foreach ($coins as $coin) {
            for ($i = $coin; $i <= $n; $i++) {
                $dp[$i] += $dp[$i - $coin];
            }
        }
        return $dp[$n] % 1000000007;
    }

    public function waysToChange1($n)
    {
        $n /= 5;
        $dp = array_fill(0, $n + 1, 1);
        $coins = [1, 2, 5];
        $mod = 1000000007;
        foreach ($coins as $coin) {
            for ($i = $coin; $i <= $n; $i++) {
                $dp[$i] += $dp[$i - $coin];
            }
        }
        return $dp[$n] % $mod;
    }

    public function waysToChange2($n)
    {
        $n = floor($n / 5);
        $result = 0;
        $count = floor($n / 5);
        for ($i = 0; $i <= $count; $i++) {
            $k = ($n - (($i << 2) + $i)) >> 1;
            $result += ($n - (($i << 2) + $i) + 1 - $k) * ($k + 1);
        }
        return $result % 1000000007;
    }
}
