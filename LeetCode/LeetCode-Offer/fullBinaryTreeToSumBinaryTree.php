<?php

function sumBinaryTree($dlr, $l1, $r1, &$ldr, $l2, $r2)
{
    if ($l2 == $r2) {
        $temp = (int) $ldr[$l2];
        $ldr[$l2] = 0;
        return $temp;
    }

    $root = $l1;
    while ($ldr[$root] != $dlr[$l1])
        $root++;

    $leftSum = sumBinaryTree($dlr, $l1 + 1, $root, $ldr, $l2, $root - 1);
    $rightSum = sumBinaryTree($dlr, $root + 1, $r1, $ldr, $root + 1, $r2);
    $temp = (int) $ldr[$root];
    $ldr[$root] = $leftSum + $rightSum;
    return $temp + (int) $ldr[$root];
}

function sumBinaryTree2(array &$ldr, int $left, int $right)
{
    $mid = ($left + $right) >> 1;
    if ($mid == $left) {
        $ldr[$mid] = 0;
        return;
    }
    $temp = -$ldr[$mid];
    for ($i = $left; $i < $right; $i++)
        $temp += $ldr[$i];
    $ldr[$mid] = $temp;
    sumBinaryTree2($ldr, $left, $mid);
    sumBinaryTree2($ldr, $mid + 1, $right);
}

/*
10 -2 8 -4 6 7 5
8 -2 -4 10 7 6 5
 */
$dlr = explode(' ', trim(fgets(STDIN)));
$ldr = explode(' ', trim(fgets(STDIN)));
// $dlr = [10, -2, 8, -4, 6, 7, 5];
// $ldr = [8, -2, -4, 10, 7, 6, 5];
// sumBinaryTree($dlr, 0, count($dlr) - 1, $ldr, 0, count($ldr) - 1);
sumBinaryTree2($ldr, 0, count($ldr));
echo implode(' ', $ldr);
