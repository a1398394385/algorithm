<?php

class Rectangle
{
    private $length;
    private $width;

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getArea()
    {
        return $this->length * $this->width;
    }
}

class Quadrate extends Rectangle
{
    private $length;
    private $width;

    public function setLength($length)
    {
        $this->length = $length;
        $this->width  = $length;
    }

    public function setWidth($width)
    {
        $this->width  = $width;
        $this->length = $width;
    }

    public function getArea()
    {
        return $this->length * $this->width;
    }
}

$rectangle = new Rectangle();
$rectangle->setLength(4);
$rectangle->setWidth(5);
$rectangle->getArea();          // return 20

$quadrate = new Quadrate();
$quadrate->setLength(5);
$quadrate->setWidth(4);
$quadrate->getArea();           // return 16
