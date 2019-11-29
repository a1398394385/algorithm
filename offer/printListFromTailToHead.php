<?php
/* 题目描述
输入一个链表，按链表从尾到头的顺序返回一个ArrayList。
 */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/

/**
 * while 循环，使用 PHP 自带数组操作函数
 *
 * @param ListNode $head
 */
function printListFromTailToHead($head)
{
    $array = [];
    while (1) {
        array_unshift($array, $head->val);
        if ($head->next)
            $head = $head->next;
        else
            break;
    }
    return $array;
}

$array = [];
/**
 * 递归
 *
 * @param ListNode $head
 */
function printListFromTailToHead2($head)
{
    if ($head) {
        if ($head->next) {
            printListFromTailToHead($head->next);
        }
        if (!isset($array))
            $array = [];
        $array[] = $head->val;
    }
    return $array;
}
