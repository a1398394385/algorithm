<?php

class Solution
{

    /**
     * @param String $s
     * @return Integer
     */
    public static function findTheLongestSubstring($s)
    {
        $VOWELS = ["a" => 1, "e" => 2, "i" => 4, "o" => 8, "u" => 16];
        $map[0] = -1;
        $result = $status = 0;
        $length = strlen($s);
        for ($i = 0; $i < $length; $i++) {
            $status ^= $VOWELS[$s[$i]] ?? 0;
            $map[$status] = $map[$status] ?? $i;
            $result = max($result, $i - $map[$status]);
        }
        return $result;
    }
}

echo Solution::findTheLongestSubstring("eleetminicoworoep");
echo PHP_EOL;
echo Solution::findTheLongestSubstring("leetcodeisgreat");
echo PHP_EOL;
echo Solution::findTheLongestSubstring("bcbcbc");
