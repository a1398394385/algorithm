<?php
class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function reversePairs(&$nums)
    {
        return $this->dp($nums, 0, count($nums) - 1);
    }

    public function dp(array &$nums, int $start, int $end): int
    {
        if ($start >= $end) return 0;
        $result = 0;
        $mid = ($start + $end) >> 1;
        $result += $this->dp($nums, $start, $mid) + $this->dp($nums, $mid + 1, $end);
        $temp = [];
        for ($p1 = $mid, $p2 = $end; $p1 >= $start && $p2 > $mid;) {
            if ($nums[$p1] > $nums[$p2]) {
                $result += $p2 - $mid;
                $temp[] = $nums[$p1--];
            } else {
                $temp[] = $nums[$p2--];
            }
        }
        while ($p1 >= $start) $temp[] = $nums[$p1--];
        while ($p2 > $mid) $temp[] = $nums[$p2--];
        $temp = array_reverse($temp);
        for ($i = 0; $i <= $end - $start; $i++)
            $nums[$i + $start] = $temp[$i];
        return $result;
    }
}

$array = [7, 5, 6, 4];
$test = new Solution();
var_dump($test->reversePairs($array));
var_dump($array);
