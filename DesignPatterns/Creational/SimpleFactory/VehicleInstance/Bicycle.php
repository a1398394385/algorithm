<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\SimpleFactory\Vehicle;

use DesignPatterns\Creational\SimpleFactory\VehicleInterface;

/**
 * 自行车
 */
class Bicycle implements VehicleInterface
{
    /**
     * @param string $destination
     * @return mixed|void
     */
    public function driveTo(string $destination)
    {
    }
}
