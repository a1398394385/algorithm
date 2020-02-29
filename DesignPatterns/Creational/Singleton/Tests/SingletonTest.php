<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Singleton\Tests;

use DesignPatterns\Creational\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    public function testUniqueness()
    {
        $firstCall = Singleton::getInstance();
        $secondCall = Singleton::getInstance();

        $this->assertInstanceOf(Singleton::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }

    public function testNoConstructor()
    {
        $obj = Singleton::getInstance();

        $refl = new \ReflectionObject($obj);
        $meth = $refl->getMethod('__construct');
        $this->assertTrue($meth->isPrivate());
    }
}
