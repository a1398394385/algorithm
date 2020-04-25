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

    function permute1(array $nums): array
    {
        $result = [];
        $queue = new \SplQueue();
        for ($i = 0; $i < count($nums); $i++) {
            $this->swap($nums, $i, 0);
            $queue->enqueue($nums);
            $index = 0;
            while ($queue->count() != 0) {
                $count = $queue->count();
                $index += 1;
                while ($count--) {
                    $temp = $queue->bottom();
                    if ($index == count($nums))
                        $result[] = $temp;
                    $queue->dequeue();
                    for ($j = $index; $j < count($nums); $j++) {
                        $this->swap($temp, $j, $index);
                        $queue->enqueue($temp);
                        $this->swap($temp, $j, $index);
                    }
                }
            }
            $this->swap($nums, $i, 0);
        }
        return $result;
    }

    function permute2(array $nums): array
    {
        $result = $queue = [];
        $numsSize = count($nums);
        for ($i = 0; $i < $numsSize; $i++) {
            $this->swap($nums, 0, $i);
            $queue[] = $nums;
            $flag = 0;
            while (count($queue) != 0) {
                $flag++;
                if ($flag >= $numsSize - 1) {
                    $result = array_merge($result, $queue);
                    $queue = [];
                    break;
                }
                $queueSize = count($queue);
                while ($queueSize--) {
                    $temp = array_shift($queue);
                    for ($j = $flag; $j < $numsSize; $j++) {
                        $this->swap($temp, $flag, $j);
                        $queue[] = $temp;
                        $this->swap($temp, $flag, $j);
                    }
                }
            }
            $this->swap($nums, 0, $i);
        }
        return $result;
    }

    function swap(array &$nums, int $index1, int $index2)
    {
        $temp = $nums[$index1];
        $nums[$index1] = $nums[$index2];
        $nums[$index2] = $temp;
    }
}

$array = [1, 2, 3];
$test = new Solution();
var_dump($test->permute($array));
