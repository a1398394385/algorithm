<?php

/*
题目描述
输入一棵二叉树，判断该二叉树是否是平衡二叉树。

class TreeNode
{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val)
    {
        $this->val = $val;
    }
} */

function IsBalanced_Solution($pRoot)
{
    return getDepth($pRoot) != -1;
}

function getDepth($root)
{
    if ($root == null)
        return 0;
    $left = getDepth($root->left);
    if ($left == -1)
        return -1;
    $right = getDepth($root->right);
    if ($right == -1)
        return -1;
    return abs($left - $right) > 1 ? -1 : 1 + max($left, $right);
}
