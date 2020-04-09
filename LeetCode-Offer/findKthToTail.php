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


function FindKthToTail($head, $k)
{
    $copyHead = $head;
    $result = ($k == 1) ? $copyHead : null;
    for ($i = 1; $head->next; $i++) {
        $head = $head->next;
        if ($i == $k - 1)
            $result = $copyHead;
        if ($i >= $k)
            $result = $result->next;
    }

    return $result;
}

function FindKthToTail2($head, $k)
{
    $tmp = $head;
    $len = 0;
    while ($head != null) {
        $len++;
        $head = $head->next;
    }
    if ($k > $len) {
        return null;
    }
    for ($i = 0; $i < $len - $k; $i++) {
        $tmp = $tmp->next;
    }
    return $tmp;
}

$head = new ListNode(1);
$head->next = new ListNode(2);
$head->next->next = new ListNode(3);
$head->next->next->next = new ListNode(4);
$head->next->next->next->next = new ListNode(5);
dd(FindKthToTail($head, 1));
