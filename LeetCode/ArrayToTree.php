<?php

class TreeNode
{
    public int $val;
    public ?TreeNode $left = null;
    public ?TreeNode $right = null;
    function __construct($value)
    {
        $this->val = $value;
    }
}

function arrayToTree(?array $tree): ?TreeNode
{
    if (empty($tree)) return null;
    $queue = new \SplQueue();
    $root = new TreeNode(array_shift($tree));
    $queue->enqueue($root);
    while (count($tree)) {
        $node = $queue->dequeue();
        $left = array_shift($tree);
        $right = array_shift($tree);
        if ($left !== null) {
            $node->left = new TreeNode($left);
            $queue->enqueue($node->left);
        }
        if ($right !== null) {
            $node->right = new TreeNode($right);
            $queue->enqueue($node->right);
        }
    }
    return $root;
}
