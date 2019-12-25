<?php

/**
 * 题目描述
 * 给出一个链表，每 k 个节点一组进行翻转，并返回翻转后的链表
 * k 是一个正整数，它的值小于或等于链表的长度
 * 如果节点总数不是 k 的整数倍，那么将最后剩余节点保持原有顺序
 * 说明：
 * 1. 你需要自行定义链表结构，将输入的数据保存到你的链表中
 * 2. 你不能只是单纯的改变节点内部的值，而是需要实际的进行节点交换
 * 3. 你的算法只能使用常数的额外空间
 *
 * example:
 * input:  1 2 3 4 5
 *         2
 * output: 2 1 4 3 5
 */

class ListNode
{
    public $data;
    public $next = null;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 每K个一组反转链表
 *
 * @param Listnode $head
 * @param int $k
 */
function reverseLinkedList($head, $k)
{
    $node = $head;
    for ($i = $k; $i > 1; $i--) {
        if (!$node || !$node->next)
            return $head;
        $node = $node->next;
    }

    $lastNode = reverseLinkedList($node->next, $k);
    $nowNode = $head;
    $nextNode = $head->next;
    for ($i = 0; $i < $k; $i++) {
        $nowNode->next = $lastNode;
        $lastNode = $nowNode;
        $nowNode = $nextNode;
        $nextNode = $nextNode->next;
    }

    return $node;
}

function arrayToList($array)
{
    $count = count($array);
    $head = new ListNode($array[0]);
    for ($i = 1, $node = $head; $i < $count; $i++) {
        $node->next = new ListNode($array[$i]);
        $node = $node->next;
    }
    return $head;
}


// TODO:Test
// $input = fread(STDIN, 1000);
// $input = explode('
// ', trim($input));
// $head = arrayToList(explode(' ', $input[0]));
// $node = reverseLinkedList($head, $input[1]);
$head = arrayToList([1, 2, 3, 4, 5]);
$node = reverseLinkedList($head, 2);
while ($node) {
    echo $node->data . ' ';
    $node = $node->next;
}
