<?php
//内存管理机制
//获取内存方法，加上true返回实际内存，不加则返回表现内存
var_dump(memory_get_usage());
$a = "laruence";
var_dump(memory_get_usage());
unset($a);
var_dump(memory_get_usage());



$a = 1;
xdebug_debug_zval('a');
echo PHP_EOL;//换行符，提高代码的源代码级可移植性


