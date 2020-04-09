<?php

/* class ListNode
{
    public $val = 0;
    public $next = null;
    function __construct($val)
    {
        $this->val = $val;
    }
} */
class Solution
{

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2)
    {
        $root = new ListNode(0);
        $node = $root;
        $temp = 0;
        while ($l1 || $l2 || $temp) {
            $add = $temp;
            $add += $l1 ? ($l1->val) : 0;
            $add += $l2 ? ($l2->val) : 0;
            @$l1 = $l1->next;
            @$l2 = $l2->next;
            $node->next = new ListNode($add % 10);
            $node = $node->next;
            $temp = floor($add / 10);
        }
        return $root->next;
    }
}
