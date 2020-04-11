<?php
class Solution
{
    public $temp = [];

    public function superEggDrop(int $K, int $N): int
    {
        return $this->dp4($K, $N);
    }

    /**
     * 动态规划
     * @param int $K
     * @param int $N
     * @return int
     */
    public function dp(int $K, int $N): int
    {
        if ($K == 1) return $N;
        if ($N == 0) return 0;
        if (isset($this->temp[$K][$N]))
            return $this->temp[$K][$N];

        $result = PHP_INT_MAX;
        for ($i = 1; $i <= $N; $i++) {
            $result = min($result, max($this->dp($K, $N - $i), $this->dp($K - 1, $i - 1)) + 1);
        }
        $this->temp[$K][$N] = $result;
        return $result;
    }

    /**
     * 动态规划，二分优化
     */
    public function dp1(int $K, int $N): int
    {
        if ($K == 1) return $N;
        if ($N == 0) return 0;
        if (isset($this->temp[$K][$N]))
            return $this->temp[$K][$N];

        $result = PHP_INT_MAX;
        $low = 1;
        $high = $N;
        while ($low <= $high) {
            $mid = ($low + $high) >> 1;
            $broken = $this->dp1($K - 1, $mid - 1);
            $notBroken = $this->dp1($K, $N - $mid);
            if ($broken > $notBroken) {
                $high = $mid - 1;
                $result = min($result, $broken + 1);
            } else {
                $low = $mid + 1;
                $result = min($result, $notBroken + 1);
            }
        }
        $this->temp[$K][$N] = $result;
        return $result;
    }

    /**
     * 逆向思维
     */
    public function dp2(int $K, int $N): int
    {
        $temp = array_fill(0, $K + 1, array_fill(0, $N + 1, 0));
        $M = 0;
        while ($temp[$K][$M] < $N) {
            $M++;
            for ($i = 1; $i <= $K; $i++) {
                $temp[$i][$M] = $temp[$i][$M - 1] + $temp[$i - 1][$M - 1] + 1;
            }
        }
        return $M;
    }

    /**
     * 逆向思维，空间优化
     */
    public function dp3(int $K, int $N): int
    {
        $temp = array_fill(0, 2, array_fill(0, $K + 1, 0));
        $M = 0;
        while ($temp[1][$K] < $N) {
            $M++;
            for ($k = 1; $k <= $K; $k++) {
                $temp[1][$k] = $temp[0][$k] + $temp[0][$k - 1] + 1;
            }
            $temp[0] = $temp[1];
        }
        return $M;
    }

    /**
     * 高层新状态依赖于低层旧状态，故：从高到低进行状态更新
     */
    public function dp4(int $K, int $N): int
    {
        $temp = array_fill(0, $K + 1, 0);
        for ($M = 0; $temp[$K] < $N; $M++) {
            for ($k = $K; $k > 0; $k--) {
                $temp[$k] = $temp[$k] + $temp[$k - 1] + 1;
            }
        }
        return $M;
    }
}
