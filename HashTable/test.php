<?php
require 'vendor/autoload.php';

use HashTable\HashTable\HashTable;

$hashTable = new HashTable;
$hashTable->create('key1', 'value1');
$hashTable->create('key2', 'value2');
$hashTable->create('key3', 'value3');
$hashTable->create('key4', 'value4');
$hashTable->create('key5', 'value5');
$hashTable->create('key6', 'value6');
$hashTable->create('key7', 'value7');
$hashTable->create('key8', 'value8');
//$hashTable->create('keya', 'valuea');
//$hashTable->create('keyb', 'valueb');
//$hashTable->create('keyc', 'valuec');
//$hashTable->create('keyd', 'valued');
//$hashTable->create('keye', 'valuee');
//$hashTable->create('keyf', 'valuef');
//$hashTable->create('keyg', 'valueg');
//$hashTable->create('keyh', 'valueh');
//$hashTable->create('keyi', 'valuei');
//$hashTable->create('keyj', 'valuej');

//$hashTable->delete('key2');
var_dump($hashTable->search('key1'));
dd($hashTable);
