<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\StaticFactory;

interface FormatterInterface
{
    public function format(string $input): string;
}
