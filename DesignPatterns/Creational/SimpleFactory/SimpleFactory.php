<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\SimpleFactory;

use InvalidArgumentException;
use UnexpectedValueException;

/**
 * 简单工厂的作用是实例化对象，而不需要客户了解这个对象属于哪个具体的子类
 * 简单工厂实例化的类具有相同的接口或者基类，在子类比较固定并不需要扩展时，可以使用简单工厂。
 *
 * 优点: 可以使用户根据参数获得对应的类实例，避免了直接实例化类，降低了耦合性
 * 缺点: 可实例化的类型在编译期间已经被确定，如果增加新类型，则需要修改工厂，不符合OCP（开闭原则）
 * 简单工厂需要知道所有要生成的类型，当子类过多或者子类层次过多时不适合使用。
 */
class SimpleFactory
{
    /**
     * 车辆仓库
     *
     * @var array
     */
    public array $typeList;

    /**
     * 注入车辆类型
     */
    public function __construct()
    {
        $handler = opendir(__DIR__ . '\\VehicleInstance');
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..") {
                $vehicles[] = explode('.', $filename)[0];
            }
        }
        closedir($handler);

        foreach ($vehicles as $vehicle) {
            $this->typeList[$vehicle] = __NAMESPACE__ . '\\VehicleInstance\\' . $vehicle;
        }
    }

    /**
     * 创建车子
     *
     * @param string $type a known vehicle type
     *
     * @return VehicleInterface a new instance of VehicleInterface
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    public function createVehicle($type): VehicleInterface
    {
        if (!array_key_exists($type, $this->typeList)) {
            throw new InvalidArgumentException("$type is not a known vehicle type");
        }

        $vehicleType = $this->typeList[$type];
        $vehicle = new $vehicleType();

        if ($vehicle instanceof VehicleInterface) {
            return $vehicle;
        }

        throw new UnexpectedValueException("$type is not valid vehicle");
    }
}
