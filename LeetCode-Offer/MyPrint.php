<?php
require '../vendor/autoload.php';

class TreeNode
{
    public $val;
    public $left = NULL;
    public $right = NULL;
    public function __construct($val)
    {
        $this->val = $val;
    }
}

/**
 * 按之字形顺序打印二叉树
 *
 * @param TreeNode $pRoot
 * @return array
 */
function MyPrint($pRoot)
{
    $result = [];
    $stack1 = new SplStack;
    $layer = true;
    $stack1->push($pRoot);
    while ($stack1->count() != 0) {
        $tempStack = new SplStack;
        $tempArr = [];
        while ($stack1->count() != 0) {
            $temp = $stack1->pop();
            if ($temp) {
                $tempArr[] = $temp->val;
                if ($layer) {
                    $tempStack->push($temp->left);
                    $tempStack->push($temp->right);
                } else {
                    $tempStack->push($temp->right);
                    $tempStack->push($temp->left);
                }
            }
        }
        if (!empty($tempArr))
            $result[] = $tempArr;
        $layer = !$layer;
        $stack1 = $tempStack;
        unset($tempStack);
    }
    return $result;
}

/**
 * 生成二叉树测试用例
 *
 * @param int $nodes Number of nodes
 * @param int $root  Root node value
 * @return TreeNode
 */
function generateBinaryTree(int $nodes, int $root = 1)
{
    $rootNode = new TreeNode($root);
    $num = 1;
    $queue = new SplQueue;
    $queue->enqueue($rootNode);
    while ($queue->count() != 0) {
        $temp = $queue->dequeue();
        if ($num < $nodes) {
            $left = new TreeNode($root + $num);
            $temp->left = $left;
            $queue->enqueue($left);
            $num++;
        }
        if ($num < $nodes) {
            $right = new TreeNode($root + $num);
            $temp->right = $right;
            $queue->enqueue($right);
            $num++;
        } else {
            break;
        }
    }
    printf("    Used %d MB\n", memory_get_usage() >> 20);

    return $rootNode;
}


// TODO: test
$i = 1;
$number = 10;
while ($i <= 7 && $i++) {
    $root = generateBinaryTree($number);
    $start = microtime(true);
    MyPrint($root);
    printf("Used %sS\n", microtime(true) - $start);
    $number *= 10;
}
