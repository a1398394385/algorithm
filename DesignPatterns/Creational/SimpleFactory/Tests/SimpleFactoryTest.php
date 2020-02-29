<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\SimpleFactory\Tests;

use DesignPatterns\Creational\SimpleFactory\SimpleFactory;
use DesignPatterns\Creational\SimpleFactory\VehicleInterface;
use PHPUnit\Framework\TestCase;

use InvalidArgumentException;
use UnexpectedValueException;

class SimpleFactoryTest extends TestCase
{
    protected SimpleFactory $factory;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->factory = new SimpleFactory();
    }

    public function getType()
    {
        return [
            ['Bicycle'],
            ['Scooter']
        ];
    }

    /**
     * @dataProvider getType
     */
    public function testCreation($type)
    {
        $obj = $this->factory->createVehicle($type);

        $this->assertInstanceOf(VehicleInterface::class, $obj);
    }

    public function testBadType()
    {
        $type = 'Car';
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($type . ' is not a known vehicle type');

        $this->factory->createVehicle($type);
    }

    public function testBadVehicle()
    {
        $type = 'BadVehicle';
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage($type . ' is not valid vehicle');

        $this->factory->createVehicle($type);
    }
}
