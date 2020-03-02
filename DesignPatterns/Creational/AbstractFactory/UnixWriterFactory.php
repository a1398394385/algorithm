<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory;

use DesignPatterns\Creational\AbstractFactory\Csv\CsvWriter;
use DesignPatterns\Creational\AbstractFactory\Csv\UnixCsvWriter;
use DesignPatterns\Creational\AbstractFactory\Json\JsonWriter;
use DesignPatterns\Creational\AbstractFactory\Json\UnixJsonWriter;

class UnixWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new UnixCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new UnixJsonWriter();
    }
}
