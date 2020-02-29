<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Singleton;

/**
 * 单例模式的作用就是保证在整个应用程序的生命周期中，任何一个时刻，单例类的实例都只存在一个，同时这个类还必须提供一个访问该类的全局访问点
 * 常见使用实例：数据库连接器;日志记录器（如果有多种用途使用多例模式）;锁定文件。
 */
final class Singleton
{
    private static ?Singleton $instance = null;

    /**
     * 通过延迟加载（首次使用时创建）获取实例
     */
    public static function getInstance(): Singleton
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 构造函数私有，不允许在外部实例化
     */
    private function __construct()
    {
    }

    /**
     * 防止对象实例被克隆
     */
    private function __clone()
    {
    }

    /**
     * 防止被反序列化
     */
    private function __wakeup()
    {
    }
}
