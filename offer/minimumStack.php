<?php

$array1 = new SplFixedArray(5);
foreach ($array1 as $key => $value) {
    $array1[$key] = $key;
}

$array2 = $array1;
$array2[0] = 5;
// var_dump($array1);

$a = 1;
$b = $a;
echo $b;
$b = 2;
echo $b;
echo $a;
