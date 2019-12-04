<?php

namespace HashTable\HashTable;

require '../vendor/autoload.php';

use function HashTable\getHash;
use HashTable\Core\StoreOperation;
use function PHPSTORM_META\argumentsSet;

class HashTable implements StoreOperation
{
    /**
     * HashTable_hashNode_array
     *
     * @var HashNode[] $arHash
     */
    private $arHash;

    /**
     * HashTable_memory_space_used_number ( Maybe we don't need this? )
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
    public $nNumOfNode;

    /**
     * HashTable_size - 1, Used for &
     *
     * @var int $nTableMask
     */
    private $nTableMask;

    /**
     * Size of table before last expansion
     *
     * @var int $nOldTableMask
     */
    private $nOldTableMask;

    /**
     * HashTable_size | min = 8
     *
     * @var int $nTableSize
     */
    public $nTableSize;

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
     * Add new data to the HashTable
     *
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function create($key, $value): bool
    {
        $hash      = getHash((string)$key);
        $hashIndex = $hash & $this->nTableMask;
        if ($this->arHash[$hashIndex]) {
            if ($this->arHash[$hashIndex]->hashTableSize == $this->nTableSize) {
                if (!$this->arHash[$hashIndex]->create($key, $value))
                    return false;

                $this->nNumOfElements += 1;
            } else {

                return $this->moveNode($hashIndex)->create($key, $value);
            }
        } else {
            $this->arHash[$hashIndex] = new HashNode(
                new Bucket($hash, $key, $value),
                $this->nTableSize
            );
            $this->nNumOfNode += 1;
            $this->nNumOfElements += 1;
            if ($hashIndex > $this->nOldTableMask) {
                $oldHashIndex = $hashIndex - ($this->nOldTableMask + 1);
                if ($this->arHash[$oldHashIndex] && $this->arHash[$oldHashIndex]->hashTableSize!= $this->nTableSize) {
                    $this->moveNode($hashIndex - ($this->nOldTableMask + 1));
                }
            }
        }

        // loadFactor == 1, capacity to double
        if ($this->nNumOfNode == $this->nTableSize)
            $this->capacity();

        return true;
    }

    /**
     * Delete nodes with the same key
     *
     * @param $key
     * @return mixed
     * @author XiaoYunSong
     */
    public function delete($key): bool
    {
        $hash = getHash($key);
        if ($this->arHash[$hash & $this->nTableMask]) {
            if ($this->arHash[$hash & $this->nTableMask]->delete($key)) {
                $this->nNumOfElements -= 1;
                return true;
            }
        } else if ($this->arHash[$hash & $this->nOldTableMask]->hashTableSize != $this->nTableSize) {
            if ($this->moveNode($hash & $this->nOldTableMask)->delete($key)) {
                $this->nNumOfElements -= 1;
                return true;
            }
        }

        return false;
    }

    /**
     * Update nodes with the same key
     *
     * @param $key
     * @param $value
     * @return mixed
     * @author XiaoYunSong
     */
    public function update($key, $value): array
    {
        $hash = getHash($key);
        if ($this->arHash[$hash & $this->nTableMask]) {
            return $this->arHash[$hash & $this->nTableMask]->update($key, $value);
        } else if ($this->arHash[$hash & $this->nOldTableMask]->hashTableSize != $this->nTableSize) {
            return $this->moveNode($hash & $this->nOldTableMask)->update($key, $value);
        }

        return [];
    }

    /**
     * Search for nodes with the same key
     *
     * @param $key
     * @return array
     * @author XiaoYunSong
     */
    public function search($key): array
    {
        $hash = getHash($key);
        if ($this->arHash[$hash & $this->nTableMask]) {
            return $this->arHash[$hash & $this->nTableMask]->search($key);
        } else if ($this->arHash[$hash & $this->nOldTableMask]->hashTableSize != $this->nTableSize) {
            return $this->moveNode($hash & $this->nOldTableMask)->search($key);
        }

        return [];
    }

    /**
     * HashTable expansion, nTableSize *= 2
     *
     * @return $this
     * @author XiaoYunSong
     */
    public function capacity()
    {
        try {
            $this->arHash->setSize($this->nTableSize + $this->nTableSize);
            $this->nTableSize    += $this->nTableSize;
            $this->nOldTableMask = $this->nTableMask;
            $this->nTableMask    = $this->nTableSize - 1;
        } catch (\InvalidArgumentException $e) {
            die($e->getMessage());
        } catch (\Exception $e) {
            die('The HashTable capacity faild');
        }

        return $this;
    }

    /**
     * Rehash the old hash node
     *
     * @param $index
     * @return $this
     * @author XiaoYunSong
     */
    public function moveNode($index)
    {
        if ($this->arHash[$index] && $this->arHash[$index]->hashTableSize != $this->nTableSize) {
            $moveDataArr          = array_reverse($this->arHash[$index]->allData());
            $this->arHash[$index] = null;
            $this->nNumOfNode     -= 1;
            foreach ($moveDataArr as $key => $value) {
                $this->nNumOfElements -= 1;
                $this->create($key, $value);
            }
        }

        return $this;
    }

    /**
     * Gets all the data in the HashTable
     *
     * @return array
     * @author XiaoYunSong
     */
    public function allData()
    {
        $result = [];
        for ($i = 0; $i < $this->nTableSize; $i++) {
            if ($this->arHash[$i]) {
                $result = array_merge($result, $this->arHash[$i]->allData());
            }
        }

        return $result;
    }
}
