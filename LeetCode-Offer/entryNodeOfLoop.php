<?php
/* class ListNode
{
    var $val;
    var $next = NULL;
    function __construct($x)
    {
        $this->val = $x;
    }
} */

function EntryNodeOfLoop($pHead)
{
    $p1 = $p2 = $pHead;
    while ($p2) {
        @$p1 = $p1->next;
        @$p2 = $p2->next->next;
        if ($p1 == $p2 && $p1) {
            for ($p1 = $pHead; $p1 != $p2; $p1 = $p1->next, $p2 = $p2->next);
            return $p1;
        }
    }
    return null;
}
