<?php

namespace HashTable\DoublyLinkedList;

require '../vendor/autoload.php';

use HashTable\HashTable\Bucket;
use function HashTable\getHash;
use HashTable\Core\StoreOperation;

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
    public function create($key, $value): bool
    {
        if (!empty($this->search($key)))
            return false;

        $node = new DoublyLinkedListNode(
            new Bucket(
                getHash($key),
                $key,
                $value
            ),
            $this->headNode
        );

        if (!$this->headNode) {
            $this->headNode = $this->lastNode = $node;
        } else {
            $this->headNode->lastNode = $node;
            $node->nextNode = $this->headNode;
            $this->headNode = $node;
        }

        $this->listLenght += 1;
        return true;
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
    public function update($key, $value): array
    {
        $result = [];
        $node = $this->headNode;
        while ($node) {
            if ($node->data) {
                if ($node->data->key == $key) {
                    $node->data->value = $value;
                    $result[$key] = $value;
                    break;
                }
            }
            $node = $node->nextNode;
        }

        return $result;
    }

    /**
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function search($key): array
    {
        $result = [];
        if ($this->lastNode && $this->lastNode->data && $this->lastNode->data->key == $key) {
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

    /**
     * @author XiaoYunSong
     */
    public function allData()
    {
        $result = [];
        $node = $this->headNode;
        while ($node) {
            if ($node->data) {
                $result[$node->data->key] = $node->data->value;
            }
            $node = $node->nextNode;
        }

        return $result;
    }
}
