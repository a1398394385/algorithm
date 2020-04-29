<?php
class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function numberOfSubarrays($nums, $k)
    {
        $count = count($nums);
        $result = $temp = $p1 = $p2 = 0;
        for (; $p1 < $count && $p2 < $count; $p2++) {
            if ($nums[$p2] & 1) {
                if ($temp == 0) $p1 = $p2;
                $temp++;
                if ($temp == $k) {
                    $result += $this->dp($nums, $p1, $p2);
                    $p1++;
                    while ($p1 < $count && ($nums[$p1] & 1) == 0) $p1++;
                    $temp--;
                }
            }
        }
        return $result;
    }

    public function dp(array $nums, int $p1, int $p2)
    {
        $temp1 = $p1 - 1;
        $temp2 = $p2 + 1;
        while ($temp1 >= 0 && ($nums[$temp1] & 1) == 0) $temp1--;
        while ($temp2 < count($nums) && ($nums[$temp2] & 1) == 0) $temp2++;
        return ($p1 - $temp1) * ($temp2 - $p2);
    }

    public function numberOfSubarrays1($nums, $k)
    {
        $map = [];
        $count = count($nums);
        $evenCount = 0;
        for ($i = 0; $i < $count; $i++) {
            if ($nums[$i] & 1) {
                $map[] = $evenCount;
                $evenCount = 0;
            } else {
                $evenCount++;
            }
        }
        $map[] = $evenCount;

        $sum = 0;
        $count = count($map);
        for ($i = 0; $i < $count; ++$i) {
            if ($i + $k >= $count)
                continue;
            $sum += ($map[$i] + 1) * ($map[$i + $k] + 1);
        }

        return $sum;
    }
}

$en = new Solution();
// var_dump($en->numberOfSubarrays([1, 1, 2, 1, 1], 3));
// var_dump($en->numberOfSubarrays([2, 4, 6], 1));
// var_dump($en->numberOfSubarrays([2, 2, 2, 1, 2, 2, 1, 2, 2, 2], 2));
var_dump($en->numberOfSubarrays1(
    [1, 2, 2, 1, 2, 1, 2, 2, 2, 2, 2, 1, 1, 1],
    4
));
