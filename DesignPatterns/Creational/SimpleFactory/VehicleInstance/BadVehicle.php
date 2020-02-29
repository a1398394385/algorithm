<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\SimpleFactory\VehicleInstance;

class BadVehicle
{
    /**
     * @param string $destination
     * @return mixed|void
     */
    public function driveTo(string $destination)
    {
    }
}
