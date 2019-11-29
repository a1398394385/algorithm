<?php

namespace HashTable\HashTable;

require '../vendor/autoload.php';

use HashTable\Core\StoreOperation;

class HashTable implements StoreOperation
{
    /**
     * HashTable_hashNode_array
     *
     * @var \SplFixedArray $arHash
     */
    public $arHash;

    /**
     * HashTable_memory_space_used_number
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
     * HashTable_hashNode_number
     *
     * @var int $nNumOfBucket
     */
    private $nNumOfNode;

    /**
     * HashTable_size - 1
     *
     * @var int $nTableMask
     */
    private $nTableMask;

    /**
     * $nTableMask - ($nTableSize / 2)
     *
     * @var int $nOldTableMask
     */
    private $nOldTableMask;

    /**
     * HashTable_size | min = 8
     *
     * @var int $nTableSize
     */
    private $nTableSize;

    /**
     * HashTable constructor.
     */
    public function __construct()
    {
        $this->nTableSize     = 8;
        $this->nTableMask     = 7;
        $this->nOldTableMask  = 7;
        $this->nNumUsed       = 0;
        $this->nNumOfElements = 0;
        $this->nNumOfNode     = 0;
        $this->arHash         = new \SplFixedArray($this->nTableSize);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function create($key, $value): void
    {
        $hash      = hash_fun((string)$key);
        $hashIndex = $hash & $this->nTableMask;
        if ($this->arHash[$hashIndex]) {
            if ($this->arHash[$hashIndex]->hashTableSize == $this->nTableSize) {
                $this->arHash[$hashIndex]->create($key, $value);
            } else {
                $this->moveNode($hashIndex)->create($key, $value);
            }
        } else {
            $this->arHash[$hashIndex] = new HashNode(
                new Bucket($hash, $key, $value),
                $this->nTableSize
            );
            $this->nNumOfNode  += 1;
            if ($hashIndex > $this->nOldTableMask) {
                $this->moveNode($hashIndex - $this->nOldTableMask);
            }
        }

        $this->nNumUsed       += 1;
        $this->nNumOfElements += 1;

        // loadFactor == 1, capacity to double
        if ($this->nNumOfNode == $this->nTableSize)
            $this->capacity();
    }

    /**
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function delete($key)
    {
        $hash = hash_fun($key);
        if ($this->arHash[$hash & $this->nTableMask]) {
            return $this->arHash[$hash & $this->nTableMask]->delete($key);
        }

        return false;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function update($key, $value)
    {
        $hash = hash_fun($key);
        if ($this->arHash[$hash & $this->nTableMask]) {
            return $this->arHash[$hash & $this->nTableMask]->update($key, $value);
        }

        return false;
    }

    /**
     * @param $key
     * @return bool
     * @author XiaoYunSong
     */
    public function search($key)
    {
        $hash = hash_fun($key);
        if ($this->arHash[$hash & $this->nTableMask]) {
            return $this->arHash[$hash & $this->nTableMask]->search($key);
        }

        return false;
    }

    public function capacity()
    {
        try {
            $this->arHash->setSize($this->nTableSize + $this->nTableSize);
            $this->nTableSize += $this->nTableSize;
            $this->nOldTableMask = $this->nTableMask;
            $this->nTableMask = $this->nTableSize - 1;
        } catch (\InvalidArgumentException $e) {
            die($e->getMessage());
        } catch (\Exception $e) {
            die('The HashTable capacity faild');
        }

        return $this;
    }

    public function moveNode($index)
    {
        //
        return $this;
    }
}
