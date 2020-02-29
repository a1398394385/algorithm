<?php

class Factory
{
    private $machine = '机器Z';

    public function processX($material)
    {
        $machine = $this->machine;
        echo "使用 {$machine} 将 {$material} 加工成产品 X \n";
    }

    public function processY($material)
    {
        $machine = $this->machine;
        echo "使用 {$machine} 将 {$material} 加工成产品 Y \n";
    }
}

$factory = new Factory();
$factory->processX('原料1');
$factory->processY('原料2');
