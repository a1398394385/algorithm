<?php

class Solution
{

    private $result = [];

    /**
     * @param Integer $n
     * @return String[]
     */
    function generateParenthesis($n)
    {
        $this->name('(', 1, 0, $n);
        return $this->result;
    }

    private function name(string $str, int $left, int $right, int $n)
    {
        if ($left > $n || $right > $n || $right > $left) return;

        if ($left == $right && $left == $n) {
            return $this->result[] = $str;
        }

        $this->name($str . '(', $left + 1, $right, $n);
        $this->name($str . ')', $left, $right + 1, $n);
    }
}


// TODO:test
$test = new solution();
var_dump($test->generateParenthesis(3));
