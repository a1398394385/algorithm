<?php

function hasPath($matrix, $rows, $cols, $path)
{
    $matrix = array_chunk(str_split($matrix), $cols);
    $used = array_fill(0, $rows, array_fill(0, $cols, 0));
    $result = false;
    for ($x = 0; $x < $rows; $x++) {
        for ($y = 0; $y < $cols; $y++) {
            if ($matrix[$x][$y] == $path[0]) {
                $result = $result || findPath($x, $y, $matrix, $used, $path);
            }
        }
    }
    return $result;
}

function findPath($x, $y, $matrix, $used, $path)
{
    if (!isset($matrix[$x][$y]) || $matrix[$x][$y] != $path[0] || $used[$x][$y] == 1)
        return false;
    if (strlen($path) == 1)
        return true;
    $used[$x][$y] = 1;
    $path = substr($path, 1);
    return (findPath($x + 1, $y, $matrix, $used, $path)
        || findPath($x - 1, $y, $matrix, $used, $path)
        || findPath($x, $y + 1, $matrix, $used, $path)
        || findPath($x, $y - 1, $matrix, $used, $path));
}


// TODO:test
$matrix = [
    ['A', 'B', 'C', 'E'],
    ['S', 'F', 'C', 'S'],
    ['A', 'D', 'E', 'E']
];
$matrix = "ABCESFCSADEE";
$matrix = "ABCESFCSADEE";
$rows = 3;
$cols = 4;
$path = "ABCCED";
$path = "ABCB";
$path = "SEE";
var_dump(hasPath($matrix, $rows, $cols, $path));
