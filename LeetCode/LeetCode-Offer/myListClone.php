<?php

require '../vendor/autoload.php';

class RandomListNode
{
    var $label;

    /**
     * @var RandomListNode $next
     */
    var $next = NULL;

    /**
     * @var RandomListNode $random
     */
    var $random = NULL;
    function __construct($x)
    {
        $this->label = $x;
    }
}

/**
 * 复杂链表的复制
 *
 * @param RandomListNode $pHead
 */
function MyClone($pHead)
{
    $head = $pHead;
    while ($head) {
        $node = new RandomListNode($head->label);
        $node->next = $head->next;
        $head->next = $node;
        $head = $node->next;
    }
    $head = $pHead;
    while ($head) {
        $head->next->random = $head->random->next;
        $head = $head->next->next ?? null;
    }
    $head = $pHead;
    $nextHead = $node = $pHead->next;
    while ($node) {
        $head->next = $head->next->next ?? null;
        $node->next = $node->next->next ?? null;
        $head = $head->next;
        $node = $node->next;
    }

    return $nextHead;
}


// TODO: Test
$head = new RandomListNode(1);
$head->next = new RandomListNode(2);
$head->next->next = new RandomListNode(3);
$head->next->next->next = new RandomListNode(4);
$head->next->next->next->next = new RandomListNode(5);
dd(MyClone($head));
