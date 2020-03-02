<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Builder\Instance;

use DesignPatterns\Creational\Builder\Builder;
use DesignPatterns\Creational\Builder\Vehicle\Vehicle;
use DesignPatterns\Creational\Builder\Vehicle\Truck;
use DesignPatterns\Creational\Builder\Parts\Vehicle\Part\Door;
use DesignPatterns\Creational\Builder\Parts\Vehicle\Part\Engine;
use DesignPatterns\Creational\Builder\Parts\Vehicle\Part\Wheel;

class TruckBuilder implements Builder
{
    private Truck $truck;

    public function addDoors()
    {
        $this->truck->setPart('rightDoor', new Door());
        $this->truck->setPart('leftDoor', new Door());
    }

    public function addEngine()
    {
        $this->truck->setPart('truckEngine', new Engine());
    }

    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Wheel());
        $this->truck->setPart('wheel2', new Wheel());
        $this->truck->setPart('wheel3', new Wheel());
        $this->truck->setPart('wheel4', new Wheel());
        $this->truck->setPart('wheel5', new Wheel());
        $this->truck->setPart('wheel6', new Wheel());
    }

    public function createVehicle()
    {
        $this->truck = new Truck();
    }

    public function getVehicle(): Vehicle
    {
        return $this->truck;
    }
}
