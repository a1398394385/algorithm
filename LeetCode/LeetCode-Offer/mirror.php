<?php
require '../vendor/autoload.php';

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
 * 二叉树镜像翻转
 *
 * @param TreeNode $root
 */
function Mirror(&$root)
{
    if ($root && ($root->left || $root->right)) {
        $left = $root->left;
        $right = $root->right;
        $root->left = Mirror($right);
        $root->right = Mirror($left);
    }

    return $root;
}

//       8
//     /  \
//    6   10
//   / \  / \
//   5  7 9 11

$root = new TreeNode(8);
$root->left = new TreeNode(6);
$root->left->left = new TreeNode(5);
$root->left->right = new TreeNode(7);
$root->right = new TreeNode(10);
$root->right->left = new TreeNode(9);
$root->right->right = new TreeNode(11);
dd(Mirror($root));
