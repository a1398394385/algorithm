<?php
class MaxHeap extends SplPriorityQueue
{
};
class MinHeap extends SplPriorityQueue
{
    public function compare($priority1, $priority2): int
    {
        return $priority2 - $priority1;
    }
}

class DataStream
{
    public $number;
    public $maxHeap;
    public $minHeap;
    public function __construct()
    {
        $this->number = 0;
        $this->maxHeap = new MaxHeap();
        $this->minHeap = new MinHeap();
    }

    public function insert($num)
    {
        if ($this->number & 1) {
            $this->minHeap->insert($num, $num);
            $temp = $this->minHeap->extract();
            $this->maxHeap->insert($temp, $temp);
        } else {
            $this->maxHeap->insert($num, $num);
            $temp = $this->maxHeap->extract();
            $this->minHeap->insert($temp, $temp);
        }

        $this->number += 1;
    }

    public function getMedian()
    {
        if ($this->number & 1)
            return $this->minHeap->top();
        else
            return ($this->minHeap->top() + $this->maxHeap->top()) / 2;
    }
}

class StaticDataStream
{
    public static $number;
    public static $maxHeap;
    public static $minHeap;

    public static function init()
    {
        static::$number = 0;
        static::$maxHeap = new MaxHeap();
        static::$minHeap = new MinHeap();
    }

    public static function insert($num)
    {
        if (static::$number & 1) {
            static::$minHeap->insert($num, $num);
            $temp = static::$minHeap->extract();
            static::$maxHeap->insert($temp, $temp);
        } else {
            static::$maxHeap->insert($num, $num);
            $temp = static::$maxHeap->extract();
            static::$minHeap->insert($temp, $temp);
        }

        static::$number += 1;
    }

    public static function getMedian()
    {
        if (static::$number & 1)
            return static::$minHeap->top();
        else
            return (static::$minHeap->top() + static::$maxHeap->top()) / 2;
    }
}
StaticDataStream::init();

function Insert($num)
{
    StaticDataStream::insert($num);
}

function GetMedian()
{
    return StaticDataStream::getMedian();
}


// TODO:Tets
$array = [5, 2, 3, 4, 1, 6, 7, 0, 8];
foreach ($array as $value) {
    Insert($value);
}

echo GetMedian();
