<?php

namespace HashTable;

require 'Node.php';

class DoublyLinkedList
{
    public $nListLenght;

    public $oHeadNode;

    public $oLastNode;

    public $nTableSize;

    public function __construct($size)
    {
        $this->nTableSize = $size;
        $this->nListLenght = 0;
        $this->oHeadNode = null;
        $this->oLastNode = null;
    }

    public function push($data)
    {
        $node = new Node($data, $this->oHeadNode);

        if (!$this->oHeadNode) {
            $this->oHeadNode = $node;
            $this->oLastNode = $node;
        } else {
            $this->oHeadNode->lastNode = $node;
            $this->oHeadNode = $node;
        }

        $this->nListLenght += 1;

        return true;
    }
}

$list = new DoublyLinkedList(8);
$list->push(1);
$list->push(2);

var_dump($list);
