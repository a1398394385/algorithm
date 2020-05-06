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
     * @param TreeNode $s
     * @param TreeNode $t
     * @return Boolean
     */
    function isSubtree(TreeNode $s, TreeNode $t)
    {
        $node = $s;
        $stack = new \SplStack();
        while ($node) {
            $stack->push($node);
            $node = $node->left;
        }

        while ($stack->count() != 0) {
            $node = $stack->pop();
            if ($node->val == $t->val) {
                $sLDR = $this->LDR($node);
                $tLDR = $this->LDR($t);
                $sCount = count($sLDR);
                $tCount = count($tLDR);
                if ($sCount == $tCount) {
                    $number = 0;
                    for ($index = 0; $index < $sCount; $index++) {
                        if ($sLDR[$index] == $tLDR[$index])
                            $number++;
                    }
                    if ($number == $sCount) return true;
                }
            }
            $node = $node->right;
            while ($node) {
                $stack->push($node);
                $node = $node->left;
            }
        }

        return false;
    }

    public function LDR(TreeNode $root): array
    {
        $node = $root;
        $result = [];
        $stack = new \SplStack();
        while ($node) {
            $stack->push($node);
            $node = $node->left;
        }

        while ($stack->count() != 0) {
            $node = $stack->pop();
            $result[] = $node->val;
            $node = $node->right;
            while ($node) {
                $stack->push($node);
                $node = $node->left;
            }
        }
        return $result;
    }

    function isSubtree1($s, $t)
    {
        if ($s == null) return false;
        if ($t == null) return true;

        if ($s->val == $t->val && $s->left == $t->left && $s->right ==  $t->right) {
            return true;
        } else {
            return $this->isSubtree1($s->left, $t) || $this->isSubtree1($s->right, $t);
        }
    }

    public function isSubtree2(TreeNode $s, TreeNode $t)
    {
        if ($s == null) return false;
        if ($t == null) return true;
        if ($s->val == $t->val && $this->isEuqal($s->left, $t->left) && $this->isEuqal($s->right, $t->right))
            return true;
        return $this->isSubtree2($s->left, $t) || $this->isSubtree2($s->right, $t);
    }

    public function isEuqal(TreeNode $s, TreeNode $t)
    {
        if ($s == $t) return true;
        if ($s == null || $t == null || $s->val != $t->val) return false;
        return $this->isEuqal($s->left, $t->left) && $this->isEuqal($s->right, $t->right);
    }
}

$en = new Solution();

$s = new TreeNode(3);
$s->left = new TreeNode(4);
$s->left->left = new TreeNode(1);
$s->left->right = new TreeNode(2);
$s->right = new TreeNode(5);
$t = new TreeNode(4);
$t->left = new TreeNode(1);
$t->right = new TreeNode(2);
var_dump($en->isSubtree($s, $t));

$s = new TreeNode(3);
$s->left = new TreeNode(4);
$s->left->left = new TreeNode(1);
$s->left->right = new TreeNode(2);
$s->left->right->left = new TreeNode(0);
$s->right = new TreeNode(5);
$t = new TreeNode(4);
$t->left = new TreeNode(1);
$t->right = new TreeNode(2);
var_dump($en->isSubtree($s, $t));

$s = new TreeNode(3);
$s->left = new TreeNode(4);
$s->left->left = new TreeNode(1);
$s->left->left->left = new TreeNode(0);
$s->left->right = new TreeNode(2);
$s->right = new TreeNode(5);
$t = new TreeNode(4);
$t->left = new TreeNode(1);
$t->right = new TreeNode(2);
var_dump($en->isSubtree($s, $t));

$root = new TreeNode(2);
$root1 = new TreeNode(2);
var_dump($root);
var_dump($root1);
var_dump($root == $root1);
