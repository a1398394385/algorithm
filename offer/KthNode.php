<?php

class TreeNode
{
    public $val;
    public $left = NULL;
    public $right = NULL;
    public function __construct($val)
    {
        $this->val = $val;
    }
}

function KthNode($pRoot, $k)
{
    $result = [];
    $stack = new SplStack;
    $node = $pRoot;
    while ($node != null || $stack->count() != 0) {
        if ($node != null) {
            $stack->push($node);
            $node = $node->left;
        } else {
            $node = $stack->pop();
            $result[] = $node;
            $node = $node->right;
        }
    }
    return isset($result[$k - 1]) ? $result[$k - 1] : null;
}


// TODO:test
$root = new TreeNode(5);
$root->left = new TreeNode(3);
$root->left->left = new TreeNode(2);
$root->left->right = new TreeNode(4);
$root->right = new TreeNode(7);
$root->right->left = new TreeNode(6);
$root->right->right = new TreeNode(8);
$root = new TreeNode(8);
$root->left = new TreeNode(6);
$root->left->left = new TreeNode(5);
$root->left->right = new TreeNode(7);
$root->right = new TreeNode(10);
$root->right->left = new TreeNode(9);
$root->right->right = new TreeNode(11);
echo KthNode($root, 1);
