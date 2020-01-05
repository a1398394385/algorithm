<?php
class TreeNode
{
    public $data;
    public $left;
    public $right;

    public function __construct(int $data, TreeNode $left = null, TreeNode $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }
}

function restoreBinaryTree(array $bfs, array $ldr, int $left, int $right, &$leafs): ?TreeNode
{
    if (empty($bfs))
        return null;
    if (count($bfs) == 1) {
        $leafs[] = $bfs[0];
        return new TreeNode((int) $bfs[0]);
    }

    for ($mid = $left; $mid <= $right; $mid++) {
        if ($ldr[$mid] == $bfs[0])
            break;
    }

    $flip_ldr = array_flip($ldr);
    $left_bfs = $right_bfs = [];
    foreach ($bfs as $value) {
        if ($flip_ldr[$value] < $mid)
            $left_bfs[] = $value;
        if ($flip_ldr[$value] > $mid)
            $right_bfs[] = $value;
    }

    return new TreeNode(
        (int) $bfs[0],
        restoreBinaryTree($left_bfs, $ldr, $left, $mid - 1, $leafs),
        restoreBinaryTree($right_bfs, $ldr, $mid + 1, $right, $leafs)
    );
}

function preOrderTraverse($tree)
{
    if ($tree == null) {
        return;
    }
    printf("%s ", $tree->data);
    preOrderTraverse($tree->left);
    preOrderTraverse($tree->right);
}

function postOrderTraverse($tree)
{
    if ($tree == null) {
        return;
    }
    postOrderTraverse($tree->left);
    postOrderTraverse($tree->right);
    printf("%s ", $tree->data);
}

// TODO:Test
// $bfs = [3, 5, 4, 2, 6, 7, 1];
// $ldr = [2, 5, 3, 6, 4, 7, 1];
$bfs = explode(' ', trim(fgets(STDIN)));
$ldr = explode(' ', trim(fgets(STDIN)));
$leafs = [];
$tree = restoreBinaryTree($bfs, $ldr, 0, count($ldr) - 1, $leafs);
echo implode(' ', $leafs);
echo PHP_EOL;
preOrderTraverse($tree);
echo PHP_EOL;
postOrderTraverse($tree);
