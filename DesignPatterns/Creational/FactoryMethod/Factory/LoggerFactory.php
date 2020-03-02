<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\FactoryMethod\Factory;

use DesignPatterns\Creational\FactoryMethod\Product\Logger;

interface LoggerFactory
{
    public function createLogger(): Logger;
}
