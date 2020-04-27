<?php
class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function singleNumbers(array $nums): array
    {
        $temp = array_reduce($nums, function ($carry, $item) {
            $carry ^= $item;
            return $carry;
        });
        $index = 0;
        while (($temp & 1) ==  0) {
            $temp >>= 1;
            $index += 1;
        }
        $num1 = $num2 = 0;
        foreach ($nums as $value) {
            if (($value >> $index) & 1)
                $num1 ^= $value;
            else
                $num2 ^= $value;
        }

        return [$num1, $num2];
    }
}
