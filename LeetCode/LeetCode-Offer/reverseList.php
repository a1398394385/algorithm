<?php
require '../vendor/autoload.php';

class ListNode
{
    var $val;
    var $next = NULL;
    function __construct($x)
    {
        $this->val = $x;
    }
}


function ReverseList($pHead)
{
    if (!$pHead || !$pHead->next) {
        return $pHead;
    }

    $head = ReverseList($pHead->next);
    $pHead->next->next = $pHead;
    $pHead->next = null;
    return $head;
}


function ReverseList2($pHead)
{
    if (!$pHead)
        return $pHead;
    $lastNode = null;
    $node = $pHead;
    $nextNode = $pHead->next;
    for (;;) {
        $node->next = $lastNode;
        if (!$nextNode)
            return $node;
        $lastNode = $node;
        $node = $nextNode;
        $nextNode = $nextNode->next;
    }
}

$head = new ListNode(1);
$head->next = new ListNode(2);
$head->next->next = new ListNode(3);
$head->next->next->next = new ListNode(4);
$head->next->next->next->next = new ListNode(5);

// dd($head);
dd(ReverseList(null));
