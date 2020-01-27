<?php

require '../vendor/autoload.php';

class ListNode
{
    public $val;
    public $next = NULL;
    public function __construct($x)
    {
        $this->val = $x;
    }
}

function deleteDuplication($pHead)
{
    $head = new ListNode(0);
    $head->next = $pHead;
    $pre = $head;
    $last = $head->next;
    while ($last != null) {
        while (isset($last->next) && $last->next->val == $last->val) {
            $temp = $last->val;
            while ($last->val == $temp)
                $last = $last->next;
        }
        $pre->next = $last;
        $pre = $pre->next;
        $last = $pre->next;
    }

    return $head->next;
}


// TODO:Test

function constructLinkedList(string $list)
{
    $listArr = explode('->', $list);
    $head = new ListNode(array_shift($listArr));
    array_reduce($listArr, function ($carry, $item) {
        $node = new ListNode($item);
        $carry->next = $node;
        return $node;
    }, $head);
    return $head;
}

$head = constructLinkedList('1->2->3->3->4->4->5');

dd(deleteDuplication($head));
