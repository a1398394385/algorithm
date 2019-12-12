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

/**
 * Undocumented function
 *
 * @param TreeNode $root
 * @param int $expectNumber
 * @param array $pash
 * @param array $allPath
 */
function FindPath($root, $expectNumber, $path = [], &$allPath = [])
{
    if (!$root)
        return $allPath;
    $path[] = $root->val;
    $expectNumber -= $root->val;
    if ($expectNumber == 0 && !$root->left && !$root->right)
        $allPath[] = $path;
    FindPath($root->left, $expectNumber, $path, $allPath);
    FindPath($root->right, $expectNumber, $path, $allPath);
    return $allPath;
}

// TODO: Test
// {10,5,12,4,7},22
// [[10, 5, 7], [10, 12]]
$root = new TreeNode(10);
$root->right = new TreeNode(5);
$root->right->right = new TreeNode(4);
$root->right->left = new TreeNode(7);
$root->left = new TreeNode(12);
$arr = FindPath($root, 22);
usort($arr, function ($a, $b) {
    return count($b) <=> count($a);
});
dd($arr);

// public class Solution {
//     private ArrayList<ArrayList<Integer>> listAll = new ArrayList<ArrayList<Integer>>();
//     private ArrayList<Integer> list = new ArrayList<Integer>();
//     public ArrayList<ArrayList<Integer>> FindPath(TreeNode root,int target) {
//         if(root == null) return listAll;
//         list.add(root.val);
//         target -= root.val;
//         if(target == 0 && root.left == null && root.right == null)
//             listAll.add(new ArrayList<Integer>(list));
//         FindPath(root.left, target);
//         FindPath(root.right, target);
//         list.remove(list.size()-1);
//         return listAll;
//     }
// }
