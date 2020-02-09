<?php

class TreeLinkNode
{
    public $val;
    public $left = NULL;
    public $right = NULL;
    public $next = NULL;
    public function __construct($x)
    {
        $this->val = $x;
    }
}

/**
 * 二叉树的下一个结点
 *
 * @param TreeLinkNode $pNode
 * @return void
 */
function GetNext($pNode)
{
    if ($pNode == null)
        return null;

    if ($pNode->right != null) {
        $pNode = $pNode->right;
        while ($pNode->left != null)
            $pNode = $pNode->left;
        return $pNode;
    }

    while ($pNode->next != null) {
        if ($pNode->next->left == $pNode)
            return $pNode->next;
        $pNode = $pNode->next;
    }

    return null;
}
