<?php

class Solution
{

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($str)
    {
        $result = $p1 = $p2 = 0;
        $window = [];
        $length = strlen($str);
        for (; $p2 < $length; $p2++) {
            if (key_exists($str[$p2], $window) && $window[$str[$p2]] >= $p1) {
                $result = max($result, $p2 - $p1);
                $p1 = $window[$str[$p2]] + 1;
            }
            $window[$str[$p2]] = $p2;
        }
        return max($result, $p2 - $p1);
    }
}
