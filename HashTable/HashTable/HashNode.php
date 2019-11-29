<?php

namespace HashTable\HashTable;

require '../vendor/autoload.php';

use HashTable\Core\Node;
use HashTable\Tree\Tree;
use function HashTable\hash_fun;
use HashTable\Core\StoreOperation;
use HashTable\DoublyLinkedList\DoublyLinkedList;

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
    public function create($key, $value): bool
    {
        if (!$this->data) {
            $this->data = new Bucket(hash_fun($key), $key, $value);
            return true;
        } else {
            if ($this->data instanceof Bucket) {
                if ($this->data->key == $key)
                    return false;

                $bucket     = $this->data;
                $this->data = new DoublyLinkedList();
                $this->data->create($bucket->key, $bucket->value);
            }

            return $this->data->create($key, $value);
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
        if ($this->data instanceof Bucket) {
            if ($this->data->key == $key)
                $this->data->value = $value;
        } else {
            return $this->data->update($key, $value);
        }

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
        if ($this->data instanceof Bucket) {
            if ($this->data->key == $key)
                $result[$this->data->key] = $this->data->value;
        } else {
            return $this->data->search($key);
        }

        return $result;
    }

    /**
     * @author XiaoYunSong
     */
    public function allData()
    {
        $result = [];
        if ($this->data instanceof Bucket) {
            $result[$this->data->key] = $this->data->value;
        } else {
            return $this->data->allData();
        }

        return $result;
    }
}
