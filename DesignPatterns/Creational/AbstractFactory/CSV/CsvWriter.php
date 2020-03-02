<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory\Csv;

interface CsvWriter
{
    public function write(array $line): string;
}
