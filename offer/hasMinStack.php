<?php

$stack = new MinStack(20);

function mypush($node)
{
    global $stack;
    $stack->push($node);
}
function mypop()
{
    global $stack;
    return $stack->pop();
}
function mytop()
{
    global $stack;
    return $stack->getTopNode();
}
function mymin()
{
    global $stack;
    return $stack->getMinNode();
}


class MinStack
{
    /**
     * The min node
     *
     * @var MinStackNode $minNode
     */
    private $minNode;

    /**
     * The top node
     *
     * @var MinStackNode $topNode
     */
    protected $topNode;

    /**
     * The stack size
     *
     * @var int $size
     */
    protected $size;

    /**
     * Number of nodes on the stack
     *
     * @var int $usedSize
     */
    protected $usedSize;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->usedSize = 0;
        $this->minNode = null;
        $this->topNode = null;
    }

    public function push($value)
    {
        if ($this->usedSize == $this->size)
            throw new RuntimeException('Stack Overflow');

        $node = new MinStackNode($value, $this->topNode);
        $this->topNode = $node;
        if (!$this->minNode)
            $this->minNode = $node;
        elseif ($value < $this->minNode->value)
            $this->minNode = $node;
        $this->usedSize += 1;
    }

    public function pop()
    {
        $node = $this->topNode;
        $this->topNode = $node->nextNode;
        if ($node == $this->minNode) {
            $this->setMinNode();
        }
        $this->usedSize -= 1;
        return $node->value;
    }

    public function getMinNode()
    {
        return $this->minNode->value;
    }

    public function getTopNode()
    {
        return $this->topNode->value;
    }

    public function setMinNode()
    {
        $minNode =  $node = $this->topNode;
        while ($node) {
            if ($node->value < $minNode->value) {
                $minNode = $node;
            }
            $node = $node->nextNode;
        }
        $this->minNode = $minNode;
    }
}

class MinStackNode
{
    public $value;

    public $nextNode;

    public function __construct($value, self $node = null)
    {
        $this->value = $value;
        $this->nextNode = $node;
    }
}
