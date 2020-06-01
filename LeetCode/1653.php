<?php

class Solution
{
    /**
     * @param Integer $target
     * @return Integer[][]
     */
    public static function findContinuousSequence($target): array
    {
        $result = [];
        $low = 1;
        $high = $low + 1;
        while ($high > $low) {
            $sum = (($high + $low) * ($high - $low + 1)) >> 1;
            if ($sum < $target) {
                $high++;
                continue;
            }

            if ($sum == $target)
                $result[] = range($low, $high);
            $low++;
        }

        return $result;
    }
}
