<?php

require_once 'debug/ArrayToTree.php';

class Solution
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q)
    {
        $pathP = $this->dp($root, $p->val);
        $pathQ = $this->dp($root, $q->val);
        $count = min(count($pathP), count($pathQ));
        $index = 0;
        for (; $index < $count; $index++) {
            if ($pathP[$index]->val != $pathQ[$index]->val)
                break;
        }
        return $pathP[$index - 1];
    }

    public function dp(?TreeNode $root, int $value): ?array
    {
        if ($root == null) return null;
        if ($root->val == $value) return [$root];
        $path = $this->dp($root->left, $value);
        if ($path == null) $path = $this->dp($root->right, $value);
        if ($path == null) return null;
        array_unshift($path, $root);
        return $path;
    }


    function lowestCommonAncestor1($root, $p, $q)
    {
        if ($root == $p || $root == $q || $root == null) return $root;

        $left = $this->lowestCommonAncestor1($root->left, $p, $q);
        $right = $this->lowestCommonAncestor1($root->right, $p, $q);

        if ($left == null) return $right;
        if ($right == null) return $left;
        return $root;
    }
}

$en  = new Solution();
$tree = [3, 5, 1, 6, 2, 0, 8, null, null, 7, 4];
$root = arrayToTree($tree);
var_dump($en->lowestCommonAncestor($root, new TreeNode(5), new TreeNode(1)));
