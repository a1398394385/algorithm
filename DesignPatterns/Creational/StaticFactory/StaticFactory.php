<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\StaticFactory;

use InvalidArgumentException;
use DesignPatterns\Creational\StaticFactory\FormatInstance\FormatNumber;
use DesignPatterns\Creational\StaticFactory\FormatInstance\FormatString;

/**
 * Note1: Remember, static means global state which is evil because it can't be mocked for tests
 * 注意1：请记住，静态表示全局状态，该状态是不好的，因为它无法为测试而模拟
 * Note2: Cannot be subclassed or mock-upped or have multiple different instances.
 * 注意2：不能被子类化或模拟化，也不能同时存在多个不同的实例。
 */

/**
 * 与简单工厂类似，该模式用于创建一组相关或依赖的对象
 * 不同之处在于静态工厂模式使用一个静态方法来创建所有类型的对象，该静态方法通常是 factory 或 build
 */
final class StaticFactory
{
    public static function factory(string $type): FormatterInterface
    {
        if ($type == 'number') {
            return new FormatNumber();
        } elseif ($type == 'string') {
            return new FormatString();
        }

        throw new InvalidArgumentException('Unknown format given');
    }
}
