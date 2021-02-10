<?php

require 'vendor/autoload.php';

class Node
{
    public $data;
    public $lastNode;
    public $nextNode;

    public function __construct(int $data, int $lastNode = null, int $nextNode = null)
    {
        $this->data = $data;
        $this->lastNode = $lastNode;
        $this->nextNode = $nextNode;
    }
}

/**
 * 循环报数
 *
 * @param int $pNum 人数
 * @param int $number 轮回数
 */
function loop(int $pNum, int $number = 3)
{
    $list = [];

    for ($i = 1; $i <= $pNum; $i++) {
        switch ($i) {
            case 1:
                $list[$i] = new Node($i, $pNum, 2);
                break;
            case $pNum:
                $list[$i] = new Node($i, $i - 1, 1);
                break;
            default:
                $list[$i] = new Node($i, $i - 1, $i + 1);
                break;
        }
    }

    $node = 1;
    while (count($list) != 1) {

        for ($i = 1; $i < $number; $i++) {
            $node = $list[$node]->nextNode;
        }

        $list[$list[$node]->lastNode]->nextNode = $list[$node]->nextNode;
        $list[$list[$node]->nextNode]->lastNode = $list[$node]->lastNode;
        $nextNode = $list[$node]->nextNode;
        unset($list[$node]);
        $node = $nextNode;
    }

    return $list[$node]->data;
}

function king($n, $m)
{
    $monkeys = range(1, $n);         //创建1到n数组
    $i = 0;

    while (count($monkeys) > 1) {
        if (($i + 1) % $m == 0) {   //$i为数组下标;$i+1为猴子标号
            unset($monkeys[$i]);
        } else {
            array_push($monkeys, $monkeys[$i]);     //如果余数不等于0，则把数组下标为$i的放最后，形成一个圆形结构
            unset($monkeys[$i]);
        }

        $i++; //$i 循环+1，不断把猴子删除，或 push到数组
    }
    return $monkeys;
    return current($monkeys);   //猴子数量等于1时输出猴子标号，得出猴王

}

function king2($n, $m)
{
    $monkeys = new SplQueue;
    for ($i = 1; $i <= $n; $i++) {
        $monkeys->enqueue($i);
    }

    $num = 1;
    $index = 0;
    while (count($monkeys) > 1) {
        if ($num == $m) {
            unset($monkeys[$index]);
            $num = 1;
            $index = ($index > count($monkeys) - 1) ? 0 : $index;
        } else {
            $num += 1;
            $index = ($index >= count($monkeys) - 1) ? 0 : $index + 1;
        }
    }

    return $monkeys->dequeue();
}

/**
 * 循环报数
 *
 * @param int $pNum 人数
 * @param int $number 轮回数
 */
function loop2(int $pNum, int $number = 3)
{
    $monkeys = SplFixedArray::fromArray(range(1, $pNum));

    $num = 1;
    $index = 0;
    $m = count($monkeys);
    while ($m > 1) {
        if (!$monkeys[$index]) {
            $index = ($index >= count($monkeys) - 1) ? 0 : $index + 1;
            continue;
        }

        if ($num == $number) {
            unset($monkeys[$index]);
            $m -= 1;
            $num = 1;
            $index = ($index >= count($monkeys) - 1) ? 0 : $index + 1;
        } else {
            $num += 1;
            $index = ($index >= count($monkeys) - 1) ? 0 : $index + 1;
        }
    }

    return array_filter($monkeys->toArray());
}

// echo time();
// echo PHP_EOL;
// var_dump(loop2(5000, 300));
// echo PHP_EOL;
echo time();
echo PHP_EOL;
var_dump(king(5000, 1500));
echo PHP_EOL;
echo time();
