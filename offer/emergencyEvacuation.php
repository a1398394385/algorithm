<?php
function subtreeLength(int $node, int $father, array $tree): int
{
    $length = 1;
    if (count($tree[$node]) != 0)
        foreach ($tree[$node] as $child)
            if ($child != $father)
                $length += subtreeLength($child, $node, $tree);
    return $length;
}

$time = 0;
$nodeNum = fscanf(STDIN, '%d')[0];
$tree = array_fill(1, $nodeNum, []);
while ($side = (array) fscanf(STDIN, '%d%d')) {
    if (count($side) != 2) break;
    array_push($tree[$side[1]], $side[0]);
    array_push($tree[$side[0]], $side[1]);
}
foreach ($tree[1] as $child) {
    $time = max($time, subtreeLength($child, 1, $tree));
}
exit((string) $time);

/*
input example
6
2 1
3 2
4 3
5 2
6 1

10
7 2
9 3
1 4
5 8
10 6
3 7
1 8
1 9
10 9
 */
