<?php
class Solution
{
    function permute($nums): array
    {
        $count = count($nums);
        $used  = array_fill(0, $count, 0);

        return $this->dp($nums, $used, $count);;
    }

    public function dp(array $nums, array $used, int $count): array
    {
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            if ($used[$i] != 1) {
                $used[$i] = 1;
                $temp = $this->dp($nums, $used, $count);
                $temp = array_map(function ($value) use ($nums, $i) {
                    array_unshift($value, $nums[$i]);
                    return $value;
                }, $temp);
                if ($temp == []) $temp[] = [$nums[$i]];
                $result = array_merge($result, $temp);
                $used[$i] = 0;
            }
        }
        return $result;
    }
}

$array = [1, 2, 3];
$test = new Solution();
var_dump($test->permute($array));
