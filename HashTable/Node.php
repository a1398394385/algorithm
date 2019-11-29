<?php

namespace HashTable;

// use HashTable\Bucket;

class Node
{
    public $data;

    public $nextNode;

    public $lastNode;

    public function __construct($data, Node $nextNode = null, Node $lastNode = null)
    {
        $this->data = $data;
        $this->nextNode = $nextNode;
        $this->lastNode = $lastNode;
    }
}
