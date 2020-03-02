<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Builder;

use DesignPatterns\Creational\Builder\Vehicle\Vehicle;

/**
 * Director 是构造器模式的一部分，它知晓构造器接口的所有内容，并在构造器实例的帮助下构建一个个复杂的对象
 *
 * 我们可以添加不同的构造器来构建一个更为复杂的对象
 */
class Director
{
    /**
     * Director 并不知道具体实现细节
     *
     * @param Builder $builder
     *
     * @return Vehicle
     */
    public function build(Builder $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}
