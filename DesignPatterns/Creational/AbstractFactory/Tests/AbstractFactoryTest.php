<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\AbstractFactory\Tests;

use DesignPatterns\Creational\AbstractFactory\WriterFactory;
use DesignPatterns\Creational\AbstractFactory\WinWriterFactory;
use DesignPatterns\Creational\AbstractFactory\UnixWriterFactory;

use DesignPatterns\Creational\AbstractFactory\Csv\CsvWriter;
use DesignPatterns\Creational\AbstractFactory\Csv\WinCsvWriter;
use DesignPatterns\Creational\AbstractFactory\Csv\UnixCsvWriter;

use DesignPatterns\Creational\AbstractFactory\Json\JsonWriter;
use DesignPatterns\Creational\AbstractFactory\Json\WinJsonWriter;
use DesignPatterns\Creational\AbstractFactory\Json\UnixJsonWriter;

use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    public function provideFactory()
    {
        return [
            [new WinWriterFactory()],
            [new UnixWriterFactory()]
        ];
    }

    public function provideUnixFactory()
    {
        return [[new UnixWriterFactory()]];
    }

    public function provideWinFactory()
    {
        return [[new WinWriterFactory()]];
    }

    /**
     * @dataProvider provideFactory
     *
     * @param WriterFactory $writerFactory
     */
    public function testCanCreateWriter(WriterFactory $writerFactory)
    {
        $this->assertInstanceOf(CsvWriter::class, $writerFactory->createCsvWriter());
        $this->assertInstanceOf(JsonWriter::class, $writerFactory->createJsonWriter());
    }

    /**
     * @dataProvider provideUnixFactory
     *
     * @param WriterFactory $writerFactory
     */
    public function testCanCreateWriterOnUnix(WriterFactory $writerFactory)
    {
        $this->assertInstanceOf(UnixCsvWriter::class, $writerFactory->createCsvWriter());
        $this->assertInstanceOf(UnixJsonWriter::class, $writerFactory->createJsonWriter());
    }

    /**
     * @dataProvider provideWinFactory
     *
     * @param WriterFactory $writerFactory
     */
    public function testCanCreateWriterOnWin(WriterFactory $writerFactory)
    {
        $this->assertInstanceOf(WinCsvWriter::class, $writerFactory->createCsvWriter());
        $this->assertInstanceOf(WinJsonWriter::class, $writerFactory->createJsonWriter());
    }
}
