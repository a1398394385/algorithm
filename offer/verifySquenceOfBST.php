<?php

function VerifySquenceOfBST($sequence)
{
    $count = count($sequence);
    if ($count == 0)
        return false;
    return judge($sequence, 0, $count - 1);
}

function judge($sequence, $left, $right)
{
    if ($left >= $right)
        return true;
    $i = $right;
    while ($i > $left && $sequence[$i - 1] > $sequence[$right]) {
        --$i;
    }
    for ($j = $i - 1; $j >= $left; --$j) {
        if ($sequence[$j] > $sequence[$right])
            return false;
    }

    return judge($sequence, $left, $i - 1) && judge($sequence, $i, $right - 1);
}

// TODO: Test
$arr = [4, 6, 7, 5];
$arr = [4, 8, 6, 12, 16, 14, 10];
$arr = [1, 2, 3, 4, 5];
$arr = [5, 4, 3, 2, 1];
var_dump(VerifySquenceOfBST($arr));
