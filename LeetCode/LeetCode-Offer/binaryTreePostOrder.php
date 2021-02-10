<?php

class TreeNode
{
    public $data;
    public $left;
    public $right;

    public function __construct($data, TreeNode $left = null, TreeNode $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }
}

function rebuildTree($preOrder, $inOrder): ?object
{
    $length = strlen($preOrder);
    if ($length == 1)
        return new TreeNode($preOrder);
    if ($length == 0)
        return null;

    for ($index = 0; $index <= $length; $index++)
        if ($inOrder[$index] == $preOrder[0])
            break;

    return new TreeNode(
        $preOrder[0],
        rebuildTree(substr($preOrder, 1, $index), substr($inOrder, 0, $index)),
        rebuildTree(substr($preOrder, 1 + $index), substr($inOrder, $index + 1))
    );
}

function postOrder($root): void
{
    if ($root == null)
        return;
    postOrder($root->left);
    postOrder($root->right);
    echo $root->data;
}

// ABDEC DBEAC
// list($preOrder, $inOrder) = ['GDAFEMHZ', 'ADEFGHMZ'];
list($preOrder, $inOrder) = fscanf(STDIN, '%s%s');
postOrder(rebuildTree($preOrder, $inOrder));
