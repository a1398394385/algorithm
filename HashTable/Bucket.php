<?php

namespace HashTable;

use SplFixedArray;

class Bucket
{
    public $nHashKey;
    public $mKey;
    public $mValue;
    public $nTableSize;

    public function __construct(int $hashKey, $key, $value, $size)
    {
        $this->nHashKey = $hashKey;
        $this->mKey = $key;
        $this->mValue = $value;
        $this->nTableSize = $size;
    }
}

$arr = new SplFixedArray(5);

$arr[0] = new Bucket(1, 1, 1, 1);
$value = $arr[0];
$mkey = $value->mKey;
$arr[0] = new Bucket(2, 2, 2, 2);

var_dump($arr[0]);
var_dump($value);
