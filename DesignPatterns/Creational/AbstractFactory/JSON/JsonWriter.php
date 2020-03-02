<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory\Json;

interface JsonWriter
{
    public function write(array $data, bool $formatted): string;
}
