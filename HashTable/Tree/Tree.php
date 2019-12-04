<?php


namespace HashTable\Tree;

require '../vendor/autoload.php';

use function HashTable\getHash;
use HashTable\HashTable\Bucket;
use HashTable\Core\StoreOperation;

class Tree implements StoreOperation
{
    /**
     * @var TreeNode $root
     */
    public $root;

    /**
     * @var int $numOfElements
     */
    public $numOfElements;

    public function create($key, $value): bool
    {
        $hash = getHash($key);
        $node = new TreeNode(new Bucket($hash, $key, $value));

        if (!$this->root) {
            $this->root = $node;
        } else {
            $fatherNode = $this->root;
            $childNode = null;
            do {
                if ($hash < $fatherNode->data->hashKey)
                    $childNode = $fatherNode->leftNode;
                if ($hash > $fatherNode->data->hashKey)
                    $childNode = $fatherNode->rightNode;
                if ($hash == $fatherNode->data->hashKey)
                    return false;
            } while ($childNode);
        }

        $this->numOfElements += 1;
        return true;
    }

    public function delete($key): bool
    {
        // TODO: Implement delete() method.
    }

    public function update($key, $value): array
    {
        // TODO: Implement update() method.
    }

    public function search($key): array
    {
        // TODO: Implement search() method.
    }

    public function allData(): array
    {
        // TODO: Implement allData() method.
    }
}
