<?php
require '../vendor/autoload.php';

class ListNode
{
    public $data;
    public $next = null;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

function separateList(ListNode $head)
{
    $p1 = $p2 = $head;
    for (;; $p1 = $p1->next, $p2 = $p2->next) {
        if ($p1 && $p1->next) {
            $p1 = $p1->next;
        } else {
            break;
        }
    }
    return $p2;
}

function reverseList(ListNode $pHead)
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

function mergeList($head1, $head2)
{
    $head = $head1;

    while ($head2) {
        $temp = $head2->next;
        $head2->next = $head1->next;
        $head1->next = $head2;
        $head1 = $head2->next;
        $head2 = $temp;
    }
    $head1->next = $head2;

    return $head;
}

function arrayToList($array)
{
    $count = count($array);
    $head = new ListNode((int) $array[0]);
    for ($i = 1, $node = $head; $i < $count; $i++) {
        $node->next = new ListNode((int) $array[$i]);
        $node = $node->next;
    }
    return $head;
}

// TODO:Test
$input = explode(',', trim(fgets(STDIN)));
$head = arrayToList($input);
$list2 = separateList($head);
$list2 = reverseList($list2);
$node = mergeList($head, $list2);
$result = [];
while ($node) {
    $result[] = $node->data;
    $node = $node->next;
}
echo implode(',', $result);
