<?php

/**
 * 题目描述
 * 输入一棵二叉搜索树，将该二叉搜索树转换成一个排序的双向链表。
 * 要求不能创建任何新的结点，只能调整树中结点指针的指向。
 */
require_once '../vendor/autoload.php';

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
 * 将二叉搜索树转换成一个排序的双向链表 --- 递归
 *
 * @param TreeNode $pRootOfTree
 * @param String $direction
 * @return TreeNode|null $pRootOfTree
 */
function Convert($pRootOfTree, $direction = 'left')
{
    if ($pRootOfTree) {
        $left = Convert($pRootOfTree->left, 'right');
        $right = Convert($pRootOfTree->right, 'left');
        if ($left) {
            $pRootOfTree->left = $left;
            $left->right = $pRootOfTree;
        }
        if ($right) {
            $pRootOfTree->right = $right;
            $right->left = $pRootOfTree;
        }

        while ($pRootOfTree->$direction) {
            $pRootOfTree = $pRootOfTree->$direction;
        }
    }

    return $pRootOfTree;
}

/**
 * 将二叉搜索树转换成一个排序的双向链表 --- 循环
 *
 * @param TreeNode $root
 * @return TreeNode|null $pRootOfTree
 */
function Convert1($root)
{
    if ($root) {
        $stack = new SplStack();
        $pointer = $root;
        $pre = null;    // 用于保存中序遍历序列的上一节点
        $isFirst = true;
        while ($pointer || $stack->count() > 0) {
            while ($pointer) {
                $stack->push($pointer);
                $pointer = $pointer->left;
            }
            $pointer = $stack->pop();
            if ($isFirst) {
                $root = $pointer;
                $pre = $root;
                $isFirst = false;
            } else {
                $pre->right = $pointer;
                $pointer->left = $pre;
                $pre = $pointer;
            }
            $pointer = $pointer->right;
        }
    }

    return $root;
}

/**
 * 将二叉搜索树转换成一个排序的双向链表 --- Morris Traversal
 *
 * @param TreeNode $root
 * @return TreeNode|null $pRootOfTree
 */
function Convert2($root)
{
    $pointer = $root;
    $pre = null;
    $result = null;

    while ($pointer) {
        while ($pointer->left) {
            $left = $pointer->left;
            while ($left->right) {
                $left = $left->right;
            }
            $left->right = $pointer;
            $temp = $pointer->left;
            $pointer->left = null;
            $pointer = $temp;
        }
        $pointer->left = $pre;
        if (!$pre) {
            $result = $pointer;
        } else {
            $pre->right = $pointer;
        }
        $pre = $pointer;
        $pointer = $pointer->right;
    }

    return $result;
}


// TODO:Test
$root = new TreeNode(10);
$root->left = new TreeNode(5);
$root->left->left = new TreeNode(4);
$root->left->left->left = new TreeNode(3);
$root->left->right = new TreeNode(6);

$root->right = new TreeNode(15);
$root->right->right = new TreeNode(16);
$root->right->right->right = new TreeNode(17);
$root->right->left = new TreeNode(14);



$number = 10000;
$i = 5;
while ($i--) {
    $copyNumber = $number;
    $start = microtime(true);
    while ($copyNumber--) {
        Convert(unserialize(serialize($root)));
    }
    printf("Used %s S\n", microtime(true) - $start);

    $copyNumber = $number;
    $start = microtime(true);
    while ($copyNumber--) {
        Convert1(unserialize(serialize($root)));
    }
    printf("Used %s S\n", microtime(true) - $start);

    $copyNumber = $number;
    $start = microtime(true);
    while ($copyNumber--) {
        Convert2(unserialize(serialize($root)));
    }
    printf("Used %s S\n", microtime(true) - $start);
    echo PHP_EOL;
}
