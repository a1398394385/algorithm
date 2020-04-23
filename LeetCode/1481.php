<?php
class Solution
{
    public $result;

    /**
     * @param Integer $n
     * @return Integer
     */
    function waysToChange($n)
    {
        $this->result = 0;
        $this->dp($n, [25, 10, 5, 1]);
        return $this->result;
    }

    public function dp(int $money, array $coins)
    {
        if ($money == 0)
            return $this->result += 1;

        $count = count($coins);
        for ($i = 0; $i < $count; $i++) {
            if ($money >= $coins[$i]) {
                $this->dp($money - $coins[$i], array_slice($coins, $i));
            }
        }
    }
}

class Solution1
{
    public function waysToChange($n)
    {
        return $this->dp($n, [25, 10, 5, 1]);
    }

    public function dp(int $money, array $coins)
    {
        if ($money == 0) return 1;

        $result = 0;
        $count = count($coins);
        for ($i = 0; $i < $count; $i++) {
            if ($money >= $coins[$i]) {
                $result += $this->dp($money - $coins[$i], array_slice($coins, $i));
            }
        }
        return $result;
    }
}

class Solution2
{
    public $cache;

    public function waysToChange($n)
    {
        $this->cache = array_fill(0, 4, []);
        return $this->dp($n, 3, [1, 5, 10, 25]) % 1000000007;
    }

    public function dp(int $money, int $last, array $coins)
    {
        if ($money == 0) return 1;
        if ($money < 0) return 0;
        if (isset($this->cache[$last][$money]))
            return $this->cache[$last][$money];

        $result = 1;
        for ($i = $last; $i > 0; $i--) {
            $result += $this->dp($money - $coins[$i], $i, $coins);
        }
        $this->cache[$last][$money] = $result;
        return $result;
    }
}

class Solution3
{
    public function waysToChange($n)
    {
        $dp = array_fill(0, $n + 1, 0);
        $dp[0] = 1;
        $coins = [25, 10, 5, 1];
        $mod = 1000000007;
        foreach ($coins as $coin) {
            for ($i = $coin; $i <= $n; $i++) {
                $dp[$i] += $dp[$i - $coin];
            }
        }
        return $dp[$n] % $mod;
    }
}

class Solution4
{
    public function waysToChange($n)
    {
        $n = floor($n / 5);
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
}

class Solution5
{
    public function waysToChange($n)
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

$test = new Solution5();

var_dump($test->waysToChange(5));
var_dump($test->waysToChange(10));
var_dump($test->waysToChange(63));
var_dump($test->waysToChange(932));
var_dump($test->waysToChange(900750));
