<?php
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function FindFirstCommonNode($pHead1, $pHead2)
{
    $p1 = $pHead1;
    $p2 = $pHead2;
    while ($p1 != $p2) {
        $p1 = ($p1 == null ? $pHead2 : $p1->next);
        $p2 = ($p2 == null ? $pHead1 : $p2->next);
    }
    return $p1;
}
