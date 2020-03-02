<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Builder\Tests;

use DesignPatterns\Creational\Builder\Director;
use DesignPatterns\Creational\Builder\Instance\CarBuilder;
use DesignPatterns\Creational\Builder\Instance\TruckBuilder;
use DesignPatterns\Creational\Builder\Vehicle\Car;
use DesignPatterns\Creational\Builder\Vehicle\Truck;
use PHPUnit\Framework\TestCase;

class DirectorTest extends TestCase
{
    public function testCanBuildTruck()
    {
        $truckBuilder = new TruckBuilder();
        $newVehicle = (new Director())->build($truckBuilder);

        $this->assertInstanceOf(Truck::class, $newVehicle);
    }

    public function testCanBuildCar()
    {
        $carBuilder = new CarBuilder();
        $newVehicle = (new Director())->build($carBuilder);

        $this->assertInstanceOf(Car::class, $newVehicle);
    }
}
