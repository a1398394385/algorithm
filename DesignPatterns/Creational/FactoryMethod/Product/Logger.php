<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\FactoryMethod\Product;

interface Logger
{
    public function log(string $message);
}
