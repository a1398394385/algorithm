<?php
class ListNode
{
    var $val;
    var $next = NULL;
    function __construct($x)
    {
        $this->val = $x;
    }
}


/**
 * 合并链表
 *
 * @param ListNode $pHead1
 * @param ListNode $pHead2
 */
function Merge($pHead1, $pHead2)
{
    if (!$pHead1) {
        return $pHead2;
    } elseif (!$pHead2) {
        return $pHead1;
    }

    if ($pHead1->val < $pHead2->val) {
        $head = new ListNode($pHead1->val);
        $pHead1 = $pHead1->next;
    } else {
        $head = new ListNode($pHead2->val);
        $pHead2 = $pHead2->next;
    }

    $node = $head;
    while ($pHead1 && $pHead2) {
        if ($pHead1->val < $pHead2->val) {
            $node->next = new ListNode($pHead1->val);
            $pHead1 = $pHead1->next;
        } else {
            $node->next = new ListNode($pHead2->val);
            $pHead2 = $pHead2->next;
        }

        $node = $node->next;
    }

    if ($pHead1) {
        $node->next = $pHead1;
    } elseif ($pHead2) {
        $node->next = $pHead2;
    }

    return $head;
}

function Merge2($pHead1, $pHead2)
{
    if (!$pHead1) {
        return $pHead2;
    } elseif (!$pHead2) {
        return $pHead1;
    }

    if ($pHead1->val <= $pHead2->val) {
        $pHead1->next = Merge2($pHead1->next, $pHead2);
        return $pHead1;
    } else {
        $pHead2->next = Merge2($pHead1, $pHead2->next);
        return $pHead2;
    }
}
