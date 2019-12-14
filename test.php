<?php

require 'vendor/autoload.php';

// function foo(&$param)
// {
//     $param = 42;
//     return $param;
// }

// $a = 23;
// echo "\$a before calling foo(): $a\n";
// $b = foo($a);
// echo "\$a after the call to foo(): $a\n";
// $b = 23;
// echo "\$a after touching the returned variable: $a\n";

// if ((print "1\n") && (print "2\n") && (print "3\n") && (print "4\n")) {
//     //;
// }

class Test
{
    // public $a;
    // public $b;
    // protected $c;
    // private $d;

    public function __construct($a = 0, $b = 0, $c = 0, $d = 0)
    {
        // $this->a = $a;
        // $this->b = $b;
        // $this->c = $c;
        // $this->d = $d;
    }
}

// $object1 = new Test(1, new Test(1, 1, 1, 1), 3, 4);
// $object2 = clone $object1;
// // $object2->b = 5;
// echo "this is 2\n";
// var_dump($object2);
// echo "this is 1\n";
// var_dump($object1);

// 强制模式
// function sumOfInts(int ...$ints)
// {
//     return array_sum($ints);
// }

// var_dump(sumOfInts(2, '3', 4.1));

// $a = 1;
// echo xdebug_debug_zval('a');
// echo PHP_EOL;

// $b = $a;
// echo xdebug_debug_zval('a');
// echo xdebug_debug_zval('b');
// echo PHP_EOL;

// $c = $b;
// echo xdebug_debug_zval('a');
// echo xdebug_debug_zval('b');
// echo xdebug_debug_zval('c');
// echo PHP_EOL;

// unset($c);
// echo xdebug_debug_zval('a');
// echo xdebug_debug_zval('b');
// echo xdebug_debug_zval('c');

// $array = range(1, 100000);

// function dummy($array)
// { }

// echo substr(xdebug_debug_zval('array'), 0, 40);
// $i = 0;
// $start = microtime(true);
// while ($i++ < 100) {
//     dummy($array);
// }
// printf("Used %sS\n", microtime(true) - $start);


// echo substr(xdebug_debug_zval('array'), 0, 40);
// $b = &$array; //注意这里, 假设我不小心把这个Array引用给了一个变量
// $i = 0;
// $start = microtime(true);
// while ($i++ < 100) {
//     dummy($array);
// }
// printf("Used %ss\n", microtime(true) - $start);

// $arr = new SplFixedArray(10);
// for ($i = 0; $i < 10; $i++) {
//     $arr[$i] = $i;
// }
