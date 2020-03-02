<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory\Csv;

class UnixCsvWriter implements CsvWriter
{
    public function write(array $line): string
    {
        return join(',', $line) . "\n";
    }
}
