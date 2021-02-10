<?php
function isBinarySearchTree(?array $root, array $tree): array
{
    if ($root == null)
        return [];

    return array_merge(
        isBinarySearchTree($tree[$root[1]], $tree),
        (array) $root[0],
        isBinarySearchTree($tree[$root[2]], $tree)
    );
}

list($num, $root) = fscanf(STDIN, '%d%d');
$tree = array_fill(0, $num + 1, null);
for ($i = 1; $i <= $num; $i++) {
    $tree[$i] = fscanf(STDIN, "%d%d%d");
}
$root = $tree[$root];
$inOrder = isBinarySearchTree($root, $tree);
for ($i = 1; $i < $num; $i++) {
    if ($inOrder[$i] < $inOrder[$i - 1])
        exit('false');
}
exit('true');

/*
5 1
5 2 3
1 0 0
3 4 5
4 0 0
6 0 0

5 1
2 2 3
1 0 0
4 4 5
3 0 0
6 0 0
 */
