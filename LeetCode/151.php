<?php
class Solution
{
    public function reverseWords(string $str): string
    {
        $str = trim($str);
        $length = strlen($str);
        if ($length > 0) {
            $this->reverse($str, 0, $length - 1);
            $left = $right = 0;
            while ($right < $length) {
                for (; $right < $length && $str[$right] != ' '; $right++);
                $this->reverse($str, $left, $right - 1);
                for ($left = $right; $right < $length && $str[$right] == ' '; $right++);
                $str = substr($str, 0, $left++ + 1) . substr($str, $right);
                $length -= $right - $left;
                $right = $left;
            }
        }
        return $str;
    }

    public function reverse(string &$str, int $start, int $end): void
    {
        for (; $start < $end; $start++, $end--) {
            $str[$start] = $str[$start] ^ $str[$end];
            $str[$end]   = $str[$start] ^ $str[$end];
            $str[$start] = $str[$start] ^ $str[$end];
        }
    }

    public function reverseWords1($str)
    {
        return implode(" ", array_reverse(array_filter(explode(" ", trim($s)))));
    }
}

echo 123;
