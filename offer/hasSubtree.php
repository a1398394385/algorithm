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
 * 判断 Tree2 是不是 Tree1 的子结构
 *
 * @param TreeNode $pRoot1
 * @param TreeNode $pRoot2
 */
function HasSubtree($pRoot1, $pRoot2)
{
    $result = false;
    if ($pRoot1 && $pRoot2) {
        if ($pRoot1->val == $pRoot2->val)
            $result = doesTree1HaveTree2($pRoot1, $pRoot2);
        if (!$result)
            $result = HasSubtree($pRoot1->left, $pRoot2);
        if (!$result)
            $result = HasSubtree($pRoot1->right, $pRoot2);
    }

    return $result;
}

/**
 * compare Tree1 and Tree2
 *
 * @param TreeNode $tree1
 * @param TreeNode $tree2
 */
function doesTree1HaveTree2($tree1, $tree2)
{
    if (!$tree2)
        return true;
    if (!$tree1 && $tree2)
        return false;
    if ($tree1->val != $tree2->val)
        return false;

    return
        doesTree1HaveTree2($tree1->left, $tree2->left)
        && doesTree1HaveTree2($tree1->right, $tree2->right);
}
