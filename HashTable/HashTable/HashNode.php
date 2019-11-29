<?php

namespace HashTable\HashTable;

require '../vendor/autoload.php';

use HashTable\Core\Node;
use HashTable\Core\StoreOperation;
use HashTable\DoublyLinkedList\DoublyLinkedList;
use HashTable\Tree\Tree;

class HashNode extends Node implements StoreOperation
{
    /**
     * @var Bucket|DoublyLinkedList|Tree|null
     */
    public $data;

    public $hashTableSize;

    public function __construct(Bucket $bucket, $size)
    {
        $this->data          = $bucket;
        $this->hashTableSize = $size;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function create($key, $value): void
    {
        if (!$this->data) {
            $this->data = new Bucket(hash_fun($key), $key, $value);
        } else {
            if ($this->data instanceof Bucket) {
                $bucket = $this->data;
                $this->data = new DoublyLinkedList();
                $this->data->create($bucket->key, $bucket->value);
            } else {
                $this->data->create($key, $value);
            }
        }
    }

    /**
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function delete($key): bool
    {
        if ($this->data instanceof Bucket) {
            if ($this->data->key == $key) {
                $this->data = null;
                return true;
            }
        } else {
            return $this->data->delete($key);
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
        if ($this->data instanceof Bucket)
            if ($this->data->key == $key)
                $this->data->value = $value;
            else
                return $this->data->update($key, $value);

        return true;
    }

    /**
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function search($key): array
    {
        $result = [];
        if ($this->data instanceof Bucket)
            if ($this->data->key == $key)
                $result[$this->data->key] = $this->data->value;
            else
                return $this->data->search($key);

        return $result;
    }

}
