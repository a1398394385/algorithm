<?php
require 'vendor/autoload.php';

use HashTable\HashTable\HashTable;

$hashTable = new HashTable;
$hashTable->create('key1', 'value1');
//$hashTable->create('key9', 'value9');
//$hashTable->create('key2', 'value2');
//$hashTable->create('key3', 'value3');
//$hashTable->create('key4', 'value4');
//$hashTable->create('key5', 'value5');
//$hashTable->create('key6', 'value6');

 dd($hashTable);
