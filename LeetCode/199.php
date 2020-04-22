<?php


class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($value)
    {
        $this->val = $value;
    }
}

class Solution
{

    /**
     * @param TreeNode $root
     * @return Integer[]
     */
    function rightSideView($root)
    {
        $queue =  $result = [];
        $queue[] = $root;
        while (!empty($queue)) {
            $result[] = $queue[0]->val;
            $temp = [];
            foreach ($queue as $node) {
                if ($node->right)
                    $temp[] = $node->right;
                if ($node->left)
                    $temp[] = $node->left;
            }
            $queue = $temp;
        }
        return $result;
    }
}

$root = new TreeNode(1);
$root->left = new TreeNode(2);
$root->left->right = new TreeNode(5);
$root->right = new TreeNode(3);
// $root->right->right = new TreeNode(4);
$test = new Solution();
var_dump($test->rightSideView($root));
