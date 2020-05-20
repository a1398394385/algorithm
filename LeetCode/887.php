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

    /*
    dp[k][m] 表示用 k 个鸡蛋移动 m 步可以“保证求解”的最大楼层数。
    假设我们有 k 个鸡蛋可以移动 m 步，考虑某一步 t 应该在哪一层丢鸡蛋？
    由于dp[k-1][t-1]的值是已经知晓的定数，所以，我们这次选择在在 dp[k-1][t-1] + 1 层丢鸡蛋，
    即多出来的这次机会和这个鸡蛋我们只往上走一层楼，取最稳妥的结果
    结果分两种情况：
        (1) 如果鸡蛋碎了，我们首先排除了该层以上的所有楼层（不管这个楼有多高），而对于剩下的 dp[k-1][t-1] 层楼，我们一定能用 k-1 个鸡蛋在 t-1 步内求解
            因此这种情况下，我们总共可以求解无限高的楼层。可见，这是一种非常好的情况，但并不总是发生。
        (2) 如果鸡蛋没碎，我们首先排除了该层以下的 dp[k-1][t-1] 层楼，此时我们还有 k 个蛋和 t-1 步，那么我们去该层以上的楼层继续测得 dp[k][t-1] 层楼
            因此这种情况下，我们总共可以求解 dp[k-1][t-1] + dp[k][t-1] + 1 层楼。
    容易想象，在所有 m 步中只要有一次出现了第一种情况，那么我们就可以求解无限高的楼层
    但“保证求解”的定义要求我们排除一切运气成分，因此我们只得认为每次移动都遇到第二种情况。于是得到递推公式：
    dp[k][t] = dp[k-1][t-1] + dp[k][t-1] + 1
    */
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
