<?php
require 'vendor/autoload.php';

use HashTable\HashTable\HashTable;

$hashTable = new HashTable;
//$hashTable->create('key1', 'value1');
//$hashTable->create('key9', 'value9');
//$hashTable->create('key2', 'value2');
//$hashTable->create('key3', 'value3');
//$hashTable->create('key4', 'value4');
//$hashTable->create('key5', 'value5');
//$hashTable->create('key6', 'value6');
//$hashTable->create('key7', 'value7');
//$hashTable->create('key8', 'value8');
//$hashTable->create('keyj', 'valuej');
//$hashTable->create('keyk', 'valuek');
//$hashTable->create('keyl', 'valuel');
//$hashTable->create('keym', 'valuem');
//$hashTable->create('keyn', 'valuen');
//$hashTable->create('keyo', 'valueo');
//$hashTable->create('keyp', 'valuep');
//$hashTable->create('keyq', 'valueq');
//$hashTable->create('keyr', 'valuer');
//$hashTable->create('keys', 'values');
//$hashTable->create('keyt', 'valuet');
//$hashTable->create('keyu', 'valueu');
//$hashTable->create('keyv', 'valuev');
//$hashTable->create('keyw', 'valuew');
//$hashTable->create('keyx', 'valuex');
//$hashTable->create('keyy', 'valuey');
//$hashTable->create('keyz', 'valuez');

$faker = Faker\Factory::create();
$value = 'value';
$arr = [];
// 50000 => 110 +- 5 S;
for ($i = 0; $i < 50000; $i++) {
    $arr[] = $faker->name;
}


//$start = microtime(true);
//foreach ($arr as $item) {
//    \HashTable\getHash($item);
//}
//printf("getHash() Used %sS\n", microtime(true) - $start);
//echo '<br>' . PHP_EOL;
//
//
//$start = microtime(true);
//foreach ($arr as $item) {
//    \HashTable\hash_fun($item);
//}
//printf("hash_fun() Used %sS\n", microtime(true) - $start);
//echo '<br>' . PHP_EOL;


$start = microtime(true);
foreach ($arr as $item) {
    $hashTable->create($item, $value);
}
printf("create() Used %sS\n", microtime(true) - $start);
echo '<br>' . PHP_EOL;
echo $hashTable->nNumOfNode;
echo '<br>' . PHP_EOL;
echo $hashTable->nTableSize;
