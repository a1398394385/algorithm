<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory;

use DesignPatterns\Creational\AbstractFactory\Csv\CsvWriter;
use DesignPatterns\Creational\AbstractFactory\Csv\WinCsvWriter;
use DesignPatterns\Creational\AbstractFactory\Json\JsonWriter;
use DesignPatterns\Creational\AbstractFactory\Json\WinJsonWriter;

class WinWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new WinCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new WinJsonWriter();
    }
}
