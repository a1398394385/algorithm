<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Builder;

use DesignPatterns\Creational\Builder\Vehicle\Vehicle;

/**
 * 建造者模式和抽象工厂模式很像，总体上，建造者模式仅仅只比抽象工厂模式多了一个 Director 的角色
 * 与抽象工厂模式相比，建造者模式一般用来创建更为复杂的对象，因为对象的创建过程更为复杂，因此将对象的创建过程独立出来组成一个新的类
 *
 * 抽像工厂模式是将对象的全部创建过程封装在工厂类中，由工厂类向客户端提供最终的产品
 * 建造者模式中，建造者类一般只提供产品类中各个组件的建造，而将完整建造过程交付给 Director,由它负责将各个组件按照特定的规则组建为产品，然后将组建好的产品交付给客户端。
 */
interface Builder
{
    public function createVehicle();

    public function addWheel();

    public function addEngine();

    public function addDoors();

    public function getVehicle(): Vehicle;
}
