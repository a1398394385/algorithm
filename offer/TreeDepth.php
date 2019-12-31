<?php

class TreeNode
{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val)
    {
        $this->val = $val;
    }
}

/**
 * The depth of a binary tree
 *
 * @param TreeNode $pRoot
 * @return int
 */
function TreeDepth($pRoot)
{
    if (!$pRoot) {
        return 0;
    }
    $left = TreeDepth($pRoot->left);
    $right = TreeDepth($pRoot->right);
    return max($left, $right) + 1;
}

/**
 * The depth of a binary tree
 *
 * @param TreeNode $pRoot
 * @return int
 */
function TreeDepth1($pRoot)
{
    if (!$pRoot) {
        return 0;
    }
    $queue = new SplQueue();
    $depth = 0;
    $queue->enqueue($pRoot);
    while (!$queue->isEmpty()) {
        while (!$queue->isEmpty())
            $fathers[] = $queue->dequeue();
        while ($father = array_shift($fathers)) {
            if ($father->left)
                $queue->enqueue($father->left);
            if ($father->right)
                $queue->enqueue($father->right);
        }
        $depth += 1;
    }

    return $depth;
}


// TODO:Test
$root = new TreeNode(1);
$root->left = new TreeNode(2);
$root->left->left = new TreeNode(3);
$root->right = new TreeNode(4);
$root->right->right = new TreeNode(5);
$root->right->right->right = new TreeNode(6);
echo TreeDepth1($root);
