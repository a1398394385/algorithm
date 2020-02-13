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

function MyPrint($pRoot): array
{
    $tree = $pRoot ? [[$pRoot]] : [];
    $result = [];
    for ($i = 0; isset($tree[$i]); $i++) {
        $temp = [];
        $valArr = [];
        foreach ($tree[$i] as $value) {
            $valArr[] = $value->val;
            if ($value->left)
                $temp[] = $value->left;
            if ($value->right)
                $temp[] = $value->right;
        }
        $result[] = $valArr;
        if (!empty($temp))
            $tree[] = $temp;
    }
    return $result;
}


/**
 * 递归
 *
 * @param TreeNode $pRoot
 * @return array
 */
function MyPrint1($pRoot): array
{
    $result = [];
    depth($pRoot, 1, $result);
    return $result;
}

function depth(?TreeNode $root, int $depth, array &$result): void
{
    if ($root == null)
        return;
    if ($depth > count($result))
        $result[] = [];
    $result[$depth - 1][] = $root->val;

    depth($root->left, $depth + 1, $result);
    depth($root->right, $depth + 1, $result);
}

// TODO:test

/**
 * 生成二叉树测试用例
 *
 * @param int $nodes Number of nodes
 * @param int $root  Root node value
 * @return TreeNode
 */
function generateBinaryTree(int $nodes, int $root = 1)
{
    if ($nodes == 0) return;
    $rootNode = new TreeNode($root);
    $num = 1;
    $queue = new SplQueue;
    $queue->enqueue($rootNode);
    while ($queue->count() != 0) {
        $temp = $queue->dequeue();
        if ($num < $nodes) {
            $left = new TreeNode($root + $num);
            $temp->left = $left;
            $queue->enqueue($left);
            $num++;
        }
        if ($num < $nodes) {
            $right = new TreeNode($root + $num);
            $temp->right = $right;
            $queue->enqueue($right);
            $num++;
        } else {
            break;
        }
    }

    return $rootNode;
}


$root = generateBinaryTree(0);
$result = MyPrint1($root);
dd($result);
