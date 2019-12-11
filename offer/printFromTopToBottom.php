<?php

/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function PrintFromTopToBottom($root)
{
    $fathers = [$root];
    $children = [];
    $result = [];

    while (!empty($fathers)) {
        foreach ($fathers as $father) {
            $result[] = $father->val;
            if ($father->left)
                $children[] = $father->left;
            if ($father->right)
                $children[] = $father->right;
        }
        $fathers = $children;
        $children = [];
    }

    return $result;
}
