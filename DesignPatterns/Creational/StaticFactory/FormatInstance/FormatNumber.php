<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\StaticFactory\FormatInstance;

use DesignPatterns\Creational\StaticFactory\FormatterInterface;

class FormatNumber implements FormatterInterface
{
    public function format(string $input): string
    {
        return number_format((int) $input);
    }
}
