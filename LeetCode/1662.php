<?php
class Solution
{

    /**
     * @param Integer $n
     * @return Integer
     */
    function sumNums($n)
    {
        $n && ($n += $this->sumNums($n - 1));
        return $n;
    }
}
