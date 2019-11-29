<?php

namespace HashTable\HashTable;

class Bucket
{
    /**
     * @var int $hashKey
     */
    public $hashKey;

    /**
     * @var mixed $key
     */
    public $key;

    /**
     * @var mixed $value
     */
    public $value;

    public function __construct($hashKey, $key, $value)
    {
        $this->hashKey = $hashKey;
        $this->key = $key;
        $this->value = $value;
    }
}
