<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\FactoryMethod\Factory;

use DesignPatterns\Creational\FactoryMethod\Product\Logger;
use DesignPatterns\Creational\FactoryMethod\Product\StdoutLogger;

class StdoutLoggerFactory implements LoggerFactory
{
    public function createLogger(): Logger
    {
        return new StdoutLogger();
    }
}
