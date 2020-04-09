<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/

/**
 * 递归
 *
 * @param TreeNode $pRoot
 * @return bool
 */
function isSymmetrical($pRoot)
{
    if ($pRoot == null)
        return true;
    return comRoot($pRoot->left, $pRoot->right);
}

function comRoot($left, $right)
{
    if ($left == null && $right == null) return true;
    if ($left == null || $right == null) return false;
    return $left->val == $right->val
        && comRoot($left->left, $right->right)
        && comRoot($left->right, $right->left);
}


/**
 * DFS
 *
 * @param TreeNode $pRoot
 * @return bool
 */
function isSymmetricalDFS($pRoot)
{
    if ($pRoot != null) {
        $stack = new SplStack;
        $stack->push($pRoot->left);
        $stack->push($pRoot->right);
        while ($stack->count() != 0) {
            $right = $stack->pop();
            $left = $stack->pop();
            if ($left == null && $right == null) continue;
            if ($left == null || $right == null) return false;
            if ($left->val != $right->val) return false;
            $stack->push($left->left);
            $stack->push($right->right);
            $stack->push($left->right);
            $stack->push($right->left);
        }
    }
    return true;
}


/**
 * BFS
 *
 * @param TreeNode $pRoot
 * @return bool
 */
function isSymmetricalBFS($pRoot)
{
    if ($pRoot != null) {
        $queue = new SplQueue;
        $queue->enqueue($pRoot->left);
        $queue->enqueue($pRoot->right);
        while ($queue->count() != 0) {
            $right = $queue->dequeue();
            $left = $queue->dequeue();
            if ($left == null && $right == null) continue;
            if ($left == null || $right == null) return false;
            if ($left->val != $right->val) return false;
            $queue->enqueue($left->left);
            $queue->enqueue($right->right);
            $queue->enqueue($left->right);
            $queue->enqueue($right->left);
        }
    }
    return true;
}
