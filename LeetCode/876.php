<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class Solution
{

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head)
    {
        $p1 = $p2 = $head;
        while ($p2->next) {
            $p1 = $p1->next;
            $p2 = $p2->next;
            if ($p2->next) {
                $p2 = $p2->next;
            } else {
                break;
            }
        }
        return $p1;
    }
}
