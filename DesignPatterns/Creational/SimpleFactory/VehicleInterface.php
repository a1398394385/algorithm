<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\SimpleFactory;

/**
 * 车辆通用接口
 */
interface VehicleInterface
{
    /**
     * @param mixed $destination
     * @return mixed|void
     */
    public function driveTo(string $destination);
}
