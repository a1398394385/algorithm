<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\SimpleFactory\VehicleInstance;

use DesignPatterns\Creational\SimpleFactory\VehicleInterface;

/**
 * 摩托车
 */
class Scooter implements VehicleInterface
{
    /**
     * @param string $destination
     * @return mixed|void
     */
    public function driveTo(string $destination)
    {
    }
}
