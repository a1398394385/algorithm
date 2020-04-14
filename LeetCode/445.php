<?php
require_once '../vendor/autoload.php';
/**
 * Definition for a singly-linked list.
 */
class ListNode
{
    public $val = 0;
    public $next = null;
    function __construct($val)
    {
        $this->val = $val;
    }
}
class Solution
{
    public $root = null;

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2)
    {
        $root1 = $l1;
        $root2 = $l2;
        while ($l1 && $l2) {
            $l1 = $l1->next;
            $l2 = $l2->next;
        }
        if ($l1 == null && $l2 != null) {
            [$temp1, $temp2] = [$l1, $root1];
            [$l1, $root1] = [$l2, $root2];
            [$l2, $root2] = [$temp1, $temp2];
        }
        while ($l1) {
            $temp = new ListNode(0);
            $temp->next = $root2;
            $root2 = $temp;
            $l1 = $l1->next;
        }
        if ($this->dp($root1, $root2)) {
            $temp = new ListNode(1);
            $temp->next = $this->root;
            $this->root = $temp;
        }
        return $this->root;
    }

    public function dp($root1, $root2)
    {
        if ($root1 == null) return 0;
        $num = $this->dp($root1->next, $root2->next);
        $add = $root1->val + $root2->val + $num;
        $node1 = new ListNode($add % 10);
        $node1->next = $this->root;
        $this->root = $node1;
        return (int) ($add >= 10);
    }
}

$node1 = new ListNode(7);
$node1->next = new ListNode(2);
$node1->next->next = new ListNode(4);
$node1->next->next->next = new ListNode(3);
$node2 = new ListNode(5);
$node2->next = new ListNode(6);
$node2->next->next = new ListNode(4);
$node1 = new ListNode(0);
$node2 = new ListNode(7);
$node2->next = new ListNode(3);
$test = new Solution();
dd($test->addTwoNumbers($node1, $node2));
