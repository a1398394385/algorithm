<?php
require '../vendor/autoload.php';
require '../binary_sort_tree.php';
/* 题目描述
输入某二叉树的前序遍历和中序遍历的结果，请重建出该二叉树
假设输入的前序遍历和中序遍历的结果中都不含重复的数字
例如输入
        前序遍历序列 {1,2,4,7,3,5,6,8}
        中序遍历序列 {4,7,2,1,5,3,8,6}
则重建二叉树并返回

前序遍历,根左右
中序遍历,左根右
后序遍历,左右根
*/

class TreeNode
{
    var $data;
    var $left = NULL;
    var $right = NULL;
    function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 根据 前序、中序 遍历反向推导二叉树
 *
 * @param array $pre 前序遍历结果
 * @param array $vin 中序遍历结果
 */
function reConstructBinaryTree($pre, $vin)
{
    if (count($pre) != count($vin) || count($pre) < 1)
        return false;

    if (count($pre) == 1)
        return new TreeNode($pre[0]);

    $vinindex = -1;
    $vinLenght = count($vin);
    for ($i = 0; $i < $vinLenght; $i++) {
        if ($vin[$i] == $pre[0]) {
            $vinindex = $i;
            break;
        }
    }
    if ($vinindex == -1)
        return false;

    $root = new TreeNode($pre[0]);

    $leftChildTreePre  = array_slice($pre, 1, $vinindex);
    $leftChildTreeVin  = array_slice($vin, 0, $vinindex);
    $rightChildTreePre = array_slice($pre, $vinindex + 1);
    $rightChildTreeVin = array_slice($vin, $vinindex + 1);

    $root->left  = reConstructBinaryTree($leftChildTreePre, $leftChildTreeVin);
    $root->right = reConstructBinaryTree($rightChildTreePre, $rightChildTreeVin);

    return $root;
}

/**
 * 反推二叉树
 *
 * @param array $pre    前序遍历
 * @param int $startPre 前序头索引
 * @param int $endPre   前序尾索引
 * @param array $in     中序遍历
 * @param int $startIn  中序头索引
 * @param int $endIn    中序尾索引
 */
function reConstructBinaryTree2($pre, $startPre, $endPre, $in, $startIn, $endIn)
{
    //
}


$pre = [1, 2, 4, 7, 3, 5, 6, 8];
$vin = [4, 7, 2, 1, 5, 3, 8, 6];
$tree = reConstructBinaryTree($pre, $vin);
preOrderTraverse($tree);
echo PHP_EOL;
midOrderTraverse($tree);
