<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory;

use DesignPatterns\Creational\AbstractFactory\Csv\CsvWriter;
use DesignPatterns\Creational\AbstractFactory\Json\JsonWriter;

/**
 * 抽象工厂模式提供一个间接的层（即“抽象工厂”）抽象一组相关或依赖对象的创建而不是直接指定具体实现类
 * 该“工厂”对象的职责是为不同平台提供创建服务
 * 客户端不需要直接创建平台对象，而是让工厂去做这件事
 * 这种机制让替换平台变得简单，因为抽象工厂的具体实现类只有在实例化的时候才出现，如果要替换的话只需要在实例化的时候指定具体实现类即可
 */
interface WriterFactory
{
    public function createCsvWriter(): CsvWriter;
    public function createJsonWriter(): JsonWriter;
}
