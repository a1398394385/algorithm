<?php

namespace HashTable;

use InvalidArgumentException;
use SplFixedArray;

class HashTable
{
    /**
     * HashTable_Bucket
     *
     * @var SplFixedArray $arHash
     */
    private $arHash;

    /**
     * HashTable_space_used_number
     *
     * @var int $nNumUsed
     */
    private $nNumUsed;

    /**
     * HashTable_elements_number
     *
     * @var int $nNumOfElements
     */
    private $nNumOfElements;

    /**
     * HashTable_Bucket_number
     *
     * @var int $nNumOfBucket
     */
    private $nNumOfBucket;

    /**
     * 散列因子
     *
     * @var int $nTableMask
     */
    private $nTableMask;

    /**
     * HashTable_size | min = 8
     *
     * @var int $nTableSize
     */
    private $nTableSize;

    public function __construct()
    {
        $this->nTableSize = 8;
        $this->nTableMask = 7;
        $this->nNumUsed = 0;
        $this->nNumOfElements = 0;
        $this->nNumOfBucket = 0;
        $this->arHash = new SplFixedArray($this->nTableSize);
    }

    public function add($key, $value)
    {
        $hash = hash_fun((string) $key);
        $hashIndex = $hash & $this->nTableMask;
        $oldValue = $this->arHash[$hashIndex];
        if ($oldValue == null) {
            if ($this->nNumOfBucket == $this->nTableMask) {
                return $this->capacity($key, $value);
            }

            $this->arHash[$hashIndex] = new Bucket($hash, $key, $value, $this->nTableSize);
            $this->nNumOfBucket += 1;
            $this->nNumOfElements += 1;
            $this->nNumUsed += 1;
        } else if ($oldValue instanceof Bucket) {
            if ($oldValue->mValue == null) {
                $oldValue->nHashKey = $hash;
                $oldValue->mKey = $key;
                $oldValue->mValue = $value;
                $oldValue->nTableSize = $this->nTableSize;
                $this->nNumOfBucket += 1;
                $this->nNumOfElements += 1;
            } else {
                if ($oldValue->nTableSize == $this->nTableSize) {
                    $this->toList($hashIndex);
                    $this->arHash[$hashIndex]->push($hash, $key, $value);
                    $this->nNumOfElements += 1;
                    $this->nNumUsed += 1;
                } else {
                    $mKey = $oldValue->mKey;
                    $mValue = $oldValue->mValue;
                    $oldValue->nHashKey = $hash;
                    $oldValue->mKey = $key;
                    $oldValue->mValue = $value;
                    $oldValue->nTableSize = $this->nTableSize;
                    $this->add($mKey, $mValue);
                }
            }
        } else if ($oldValue instanceof DoublyLinkedList) {
            if ($oldValue->nTableSize == $this->nTableSize) {
                $oldValue->push($hash, $key, $value);
                $this->nNumOfElements += 1;
                $this->nNumUsed += 1;
            } else {
                $this->arHash[$hashIndex] = new Bucket($hash, $key, $value, $this->nTableSize);
                $this->nNumOfElements += 1;
                $this->nNumUsed += 1;
                $this->mobile($oldValue);
            }
        }

        return true;
    }

    public function capacity($key, $value)
    {
        try {
            $oldSize = $this->nTableSize;
            $this->nTableSize += $this->nTableSize;
            $this->arHash->setSize($this->nTableSize);
            $this->nTableMask = $this->nTableSize - 1;
        } catch (InvalidArgumentException $e) {
            $this->nTableSize = $oldSize;
            die($e->getMessage());
        } catch (E_WARNING $e) {
            $this->nTableSize = $oldSize;
            die('The HashTable capacity faild');
        }

        return $this->add($key, $value);
    }


    public function toList(int $hashIndex)
    {
        $oldValue = $this->arHash[$hashIndex];
        $this->arHash[$hashIndex] = new DoublyLinkedList($this->nTableSize);
    }
}
