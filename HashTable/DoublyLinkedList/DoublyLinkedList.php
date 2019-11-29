<?php

namespace HashTable\DoublyLinkedList;

require '../vendor/autoload.php';

use HashTable\Core\StoreOperation;
use HashTable\HashTable\Bucket;

/**
 * Class DoublyLinkedList
 * @package HashTable\DoublyLinkedList
 */
class DoublyLinkedList implements StoreOperation
{
    /**
     * @var int $listLenght
     */
    public $listLenght;

    /**
     * @var DoublyLinkedListNode $headNode
     */
    public $headNode;

    /**
     * @var DoublyLinkedListNode $lastNode
     */
    public $lastNode;

    /**
     * DoublyLinkedList constructor.
     */
    public function __construct()
    {
        $this->listLenght = 0;
        $this->headNode = null;
        $this->lastNode = null;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function create($key, $value): void
    {
        $node = new DoublyLinkedListNode(
            new Bucket(
                hash_fun($key),
                $key,
                $value
            ),
            $this->headNode
        );

        if (!$this->headNode) {
            $this->headNode = $node;
            $this->lastNode = $node;
        } else {
            $this->headNode->lastNode = $node;
            $node->nextNode = $this->headNode;
            $this->headNode = $node;
        }

        $this->listLenght += 1;
    }

    /**
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function delete($key): bool
    {
        $node = $this->headNode;
        while ($node) {
            if ($node->data) {
                if ($node->data->key == $key) {
                    $node->data = null;
                    return true;
                }
            }
            $node = $node->nextNode;
        }

        return false;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function update($key, $value): bool
    {
        $node = $this->headNode;
        while ($node) {
            if ($node->data) {
                if ($node->data->key == $key) {
                    $node->data->value = $value;
                    return true;
                }
            }
            $node = $node->nextNode;
        }

        return false;
    }

    /**
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function search($key): array
    {
        $result = [];
        if ($this->lastNode->data->key == $key) {
            $result[$key] = $this->lastNode->data->value;
        } else {
            $node = $this->headNode;
            while ($node) {
                if ($node->data) {
                    if ($node->data->key == $key) {
                        $result[$key] = $node->data->value;
                        break;
                    }
                }
                $node = $node->nextNode;
            }
        }

        return $result;
    }
}
