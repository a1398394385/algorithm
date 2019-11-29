<?php

namespace HashTable\Tree;

use HashTable\Core\Node;
use HashTable\HashTable\Bucket;

class TreeNode extends Node
{
    /**
     * @var Bucket $data
     */
    public $data;

    /**
     * @var TreeNode $leftNode
     */
    public $leftNode;

    /**
     * @var TreeNode $rightNode
     */
    public $rightNode;

    public function __construct(Bucket $data, self $leftNode = null, self $rightNode = null)
    {
        $this->data = $data;
        $this->leftNode = $leftNode;
        $this->rightNode = $rightNode;
    }
}
