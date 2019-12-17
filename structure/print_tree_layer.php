<?php

require 'binary_sort_tree.php';

$tree = new BinarySortedTree();
for ($i = 0; $i < 500; $i++) {
    $tree->insert(random_int(1, 1000));
}
print_layer($tree->getTree());

function print_layer(Node $tree)
{
    if (!$tree->data) {
        echo '树为空!';
    }

    $fathers = array($tree);
    $children = array();

    while (!empty($fathers)) {
        foreach ($fathers as $father) {
            echo $father->data;
            echo '  ';
            if ($father->left) {
                $children[] = $father->left;
            }
            if ($father->right) {
                $children[] = $father->right;
            }
        }
        echo '<br>';
        echo PHP_EOL;
        $fathers = $children;
        $children = array();
    }
}
