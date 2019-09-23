<?php

class AVLNode
{
    public $data;             // 节点数据
    public $left = null;      // 左子结点
    public $right = null;     // 右子节点
    public $bf = 0;           // 平衡因子BF
    public $parent = null;    // 存储父节点

    public function __construct($data)
    {
        $this->data = $data;
    }
}

class AVLTree
{
    /**
     * 根节点
     * @var AVLNode
     */
    private $root;

    const LH = 1;   // 左子树高（高度差）
    const EH = 0;   // 等高
    const RH = -1;  // 右子树高（高度差）

    public function getTree()
    {
        return $this->root;
    }

    /**
     * @param int $data
     */
    public function insert(int $data)
    {
        $this->insert_node($data, $this->root);
    }

    /**
     * 插入节点
     * @param int $data
     * @param AVLNode $tree
     * @return bool
     */
    protected function insert_node(int $data, &$tree)
    {
        if (!$tree) {
            $tree = new AVLNode($data);
            $tree->bf = self::EH;
            return true;
        }

        if ($data < $tree->data) {
            if (!$this->insert_node($data, $tree->left)) {
                return false;
            } else {
                if (empty($tree->left->parent)) {
                    $tree->left->parent = $tree;
                }
                switch ($tree->bf) {
                    case self::LH:
                        $this->left_balance($tree);
                        return false;
                    case self::EH:
                        $tree->bf = self::LH;
                        return true;
                    case self::RH:
                        $tree->bf = self::EH;
                        return false;
                }
            }
        } else {
            if (!$this->insert_node($data, $tree->right)) {
                return false;
            } else {
                if (empty($tree->right->parent)) {
                    $tree->right->parent = $tree;
                }
                switch ($tree->bf) {
                    case self::LH:
                        $tree->bf = self::EH;
                        return false;
                    case self::EH:
                        $tree->bf = self::RH;
                        return true;
                    case self::RH:
                        $this->right_balance($tree);
                        return false;
                }
            }
        }
    }

    /**
     * 右旋操作
     * @param AVLNode $tree
     */
    protected function right_rotate(&$tree)
    {
        $subTree = $tree->left;  // 将子树的左节点作为新的子树根节点
        if ($tree->parent) {
            $subTree->parent = $tree->parent;  // 更新新子树根节点的父节点
            $left = false;
            if ($tree->parent->left == $tree) {
                $left = true;
            }
        } else {
            $subTree->parent = null;
        }
        $tree->left = $subTree->right;  // 将原来左节点的右子树挂到老的根节点的左子树
        $tree->parent = $subTree;
        $subTree->right = $tree;  // 将老的根节点作为新的根节点的右子树
        $tree = $subTree;
        if (!$tree->parent) {
            $this->root = $tree;
        } else {
            // 更新老的子树根节点父节点指针指向新的根节点
            if ($left) {
                $tree->parent->left = $tree;
            } else {
                $tree->parent->right = $tree;
            }
        }
    }

    /**
     * 左旋操作
     * @param AVLNode $tree
     */
    protected function left_rotate(&$tree)
    {
        $subTree = $tree->right;     // 逻辑和右旋正好相反
        $oldTree = clone $tree;
        if ($tree->parent) {
            $subTree->parent = $tree->parent;
            $left = true;
            if ($tree->parent->right == $tree) {
                $left = false;
            }
        } else {
            $subTree->parent = null;
        }
        $tree->right = $subTree->left;
        $tree->parent = $subTree;
        $subTree->left = $tree;
        $tree = $subTree;
        if (!$tree->parent) {
            $this->root = $tree;
        } else {
            if ($left) {
                $tree->parent->left = $tree;
            } else {
                $tree->parent->right = $tree;
            }
        }
    }

    /**
     * 左子树平衡旋转处理
     * @param AVLNode $tree
     */
    protected function left_balance(&$tree)
    {
        $subTree = $tree->left;
        switch ($subTree->bf) {
            case self::LH:
                // 新插入节点在左子节点的左子树上要做右单旋处理
                $tree->bf = $subTree->bf = self::EH;
                $this->right_rotate($tree);
                break;
            case self::RH:
                // 新插入节点在左子节点的右子树上要做双旋处理
                $subTree_r = $subTree->right;
                switch ($subTree_r->bf) {
                    case self::LH:
                        $tree->bf = self::RH;
                        $subTree->bf = self::EH;
                        break;
                    case self::EH:
                        $tree->bf = $subTree->bf = self::EH;
                        break;
                    case self::RH:
                        $tree->bf = self::EH;
                        $subTree->bf = self::LH;
                        break;
                }
                $subTree_r->bf = self::EH;
                $this->left_rotate($subTree);
                $this->right_rotate($tree);
        }
    }

    /**
     * 右子树平衡旋转处理
     */
    protected function right_balance(&$tree)
    {
        $subTree = $tree->right;
        switch ($subTree->bf) {
            case self::RH:
                // 新插入节点在右子节点的右子树上要做左单旋处理
                $tree->bf = $subTree->bf = self::EH;
                $this->left_rotate($tree);
                break;
            case self::LH:
                // 新插入节点在右子节点的左子树上要做双旋处理
                $subTree_l = $subTree->left;
                switch ($subTree_l->bf) {
                    case self::RH:
                        $tree->bf = self::LH;
                        $subTree->bf = self::EH;
                        break;
                    case self::EH:
                        $tree->bf = $subTree->bf = self::EH;
                        break;
                    case self::LH:
                        $tree->bf = self::EH;
                        $subTree->bf = self::RH;
                        break;
                }
                $subTree_l->bf = self::EH;
                $this->right_rotate($subTree);
                $this->left_rotate($tree);
        }
    }
}


$avlTree = new AVLTree();
$avlTree->insert(3);
$avlTree->insert(2);
$avlTree->insert(1);
$avlTree->insert(4);
$avlTree->insert(5);
$avlTree->insert(6);
$avlTree->insert(7);
$avlTree->insert(10);
$avlTree->insert(9);
$avlTree->insert(8);
midOrderTraverse($avlTree->getTree());  // 中序遍历生成的二叉树看是否是二叉排序树
print_r($avlTree->getTree());           // 以数组形式打印构建的二叉树看是否是平衡二叉树
