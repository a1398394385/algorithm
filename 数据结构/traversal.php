<?php

/**
 * @author Mr.XYS <xys159753@gmail.com>
 * 二叉链表节点
 */
class Node
{
    public $data;
    public $left  = null;
    public $right = null;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 前序遍历
 * @param Node $tree
 * @return void
 */
function preOrderTraverse($tree)
{
    if ($tree == null) {
        return;
    }
    printf("%s\n", $tree->data);
    preOrderTraverse($tree->left);
    preOrderTraverse($tree->right);
}

/**
 * 中序遍历
 * @param Node $tree
 * @return void
 */
function midOrderTraverse($tree)
{
    if ($tree == null) {
        return;
    }
    midOrderTraverse($tree->left);
    printf("%s\n", $tree->data);
    midOrderTraverse($tree->right);
}

/**
 * 后序遍历
 * @param Node $tree
 * @return void
 */
function postOrderTraverse($tree)
{
    if ($tree == null) {
        return;
    }
    postOrderTraverse($tree->left);
    postOrderTraverse($tree->right);
    printf("%s\n", $tree->data);
}

$node1 = new Node('A');
$node2 = new Node('B');
$node3 = new Node('C');
$node1->left = $node2;
$node1->right = $node3;

$node1 = new Node('A');
$node2 = new Node('B');
$node3 = new Node('C');
$node1->left = $node2;
$node1->right = $node3;
