<?php

/**
 * @author Mr.XYS <xys159753@gmail.com>
 * 节点
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

    public function __toString()
    {
        $self  = $this->data;
        $left  = $this->left->date;
        $right = $this->right->date;
        $data = "
            self  = {$self}
            left  = {$left}
            right = {$right}
        ";
        return $data;
    }
}

/**
 * 二叉查找树基本类
 */
class BinarySortedTree
{
    /**
     * @var Node
     */
    private $tree;

    public function getTree()
    {
        return $this->tree;
    }

    /**
     * 插入新节点
     * @param integer $data 要插入的值
     * @return void
     */
    public function insert(int $data)
    {
        if (!$this->tree) {
            $this->tree = new Node($data);
            return;
        }

        $p = $this->tree;
        while ($p) {
            if ($data < $p->data) {
                if (!$p->left) {
                    $p->left = new Node($data);
                    return;
                }
                $p = $p->left;
            } else if ($data > $p->data) {
                if (!$p->right) {
                    $p->right = new Node($data);
                    return;
                }
                $p = $p->right;
            } else if ($data = $p->data) {
                return;
            }
        }
    }

    /**
     * 查找节点
     * @param integer $data 要查找的值
     * @return void
     */
    public function find(int $data)
    {
        $p = $this->tree;
        while ($p) {
            if ($data < $p->data) {
                $p = $p->left;
            } elseif ($data > $p->data) {
                $p = $p->right;
            } else {
                return $p;
            }
        }
        return '无该节点';
    }

    /**
     * 删除节点
     * @param integer $data 要删除的节点的值
     * @return void
     */
    public function delete(int $data)
    {
        if (!$this->tree) {
            return;
        }

        $p = $this->tree;
        $pp = null;  // p 的父节点
        // 查找待删除节点
        while ($p && $p->data != $data) {
            $pp = $p;
            if ($data > $p->data) {
                $p = $p->right;
            } else {
                $p = $p->left;
            }
        }

        // 指定删除数据在二叉树中不存在
        if ($p == null) {
            return;
        }

        // 待删除节点有两个子节点
        if ($p->left && $p->right) {
            $minP = $p->right;  // 右子树中的最小节点
            $minPP = $p;  // $minP 的父节点
            // 查找右子树中的最小节点
            while ($minP->left) {
                $minPP = $minP;
                $minP = $minP->left;
            }
            $p->data = $minP->data;  // 将 $minP 的数据设置到 $p 中
            $p = $minP;  // 下面就变成删除 $minP 了
            $pp = $minPP;
        }

        $child = null;
        if ($p->left) {
            $child = $p->left;
        } elseif ($p->right) {
            $child = $p->right;
        } else {
            $child = null;
        }

        if (!$pp) {
            $this->tree = $child;   // 删除的是根节点
        } elseif ($pp->left == $p) {
            $pp->left = $child;
        } else {
            $pp->right = $child;
        }
    }
}

/**
 * 前序遍历,根左右
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
 * 中序遍历,左根右
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
 * 后序遍历,左右根
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


$tree = new BinarySortedTree();
// for ($i = 0; $i < 2000; $i++) {
//     $tree->insert(random_int(1, 10000));
// }
// $tree->insert(3);
// $tree->insert(2);
// $tree->insert(5);
// $tree->insert(1);
// $tree->insert(9);
// $tree->insert(32);
// $tree->insert(23);
// $tree->insert(4);
// $tree->insert(24);
// $tree->insert(8);
// $tree->insert(24);
// $tree->insert(87);
$tree->insert(12);
$tree->insert(5);
$tree->insert(18);
$tree->insert(2);
$tree->insert(9);
$tree->insert(8);
$tree->insert(15);
$tree->insert(19);
$tree->insert(17);
$tree->insert(16);
// midOrderTraverse($tree->getTree());
// echo PHP_EOL;
// preOrderTraverse($tree->getTree());
// echo PHP_EOL;
postOrderTraverse($tree->getTree());
// var_dump($tree->find(random_int(1, 1000)));
// echo $tree->find(random_int(1, 10000));

// $data = [1, 2, 3, 4, 5, 6];
// array_map(function ($value) {
//     echo $value;
// }, $data);
