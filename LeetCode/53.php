<?php
class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums)
    {
        $result = $sum = PHP_INT_MIN;
        foreach ($nums as $num) {
            $sum = $sum < 0 ? $num : $sum + $num;
            $result = $sum > $result ? $sum : $result;
        }
        return $result;
    }

    function maxSubArray1($nums)
    {
        $pre = 0;
        $maxAns = $nums[0];
        foreach ($nums as $num) {
            $pre = max($pre + $num, $num);
            $maxAns = max($maxAns, $pre);
        }
        return $maxAns;
    }
}


class Solution1
{
    public function pushUp(array $left, array $right): array
    {
        $lSum = max($left['lSum'], $left['iSum'] + $right['lSum']);
        $rSum = max($right['rSum'], $right['iSum'] + $left['rSum']);
        $mSum = max(max($left['mSum'], $right['mSum']), $left['rSum'] + $right['lSum']);
        $iSum = $left['iSum'] + $right['iSum'];
        return [
            'lSum' => $lSum, 'rSum' => $rSum,
            'mSum' => $mSum, 'iSum' => $iSum
        ];
    }

    public function get(array &$array, int $left, int $right): array
    {
        if ($left == $right)
            return [
                'lSum' => $array[$left], 'rSum' => $array[$left],
                'mSum' => $array[$left], 'iSum' => $array[$left]
            ];
        $m = ($left + $right) >> 1;
        $lSub = $this->get($array, $left, $m);
        $rSub = $this->get($array, $m + 1, $right);
        return $this->pushUp($lSub, $rSub);
    }

    public function maxSubarray(array $nums): int
    {
        return $this->get($nums, 0, count($nums) - 1)['mSum'];
    }
}
