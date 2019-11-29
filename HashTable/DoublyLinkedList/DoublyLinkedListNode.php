<?php

namespace HashTable\DoublyLinkedList;

use HashTable\Core\Node;
use HashTable\HashTable\Bucket;

class DoublyLinkedListNode extends Node
{

    /**
     * @var Bucket $data
     */
    public $data;

    /**
     * @var DoublyLinkedListNode $nextNode
     */
    public $nextNode;

    /**
     * @var DoublyLinkedListNode $lastNode
     */
    public $lastNode;

    /**
     * DoublyLinkedListNode constructor.
     * @param Bucket $data
     * @param self|null $nextNode
     * @param self|null $lastNode
     */
    public function __construct(Bucket $data, self $nextNode = null, self $lastNode = null)
    {
        $this->data = $data;
        $this->nextNode = $nextNode;
        $this->lastNode = $lastNode;
    }
}
