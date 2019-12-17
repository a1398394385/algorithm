<?php

class Heap
{
    private $a = [];
    private $n;
    private $count;

    public function __construct($capacity = 10)
    {
        $this->n = $capacity;
        $this->count = 0;
    }

    public function insert($data)
    {
        if ($this->count >= $this->n) {
            return false;
        }
        $this->count++;
        $this->a[$this->count] = $data;
        $i = $this->count;
        while (floor($i / 2) > 0 && $this->a[floor($i / 2)] > $this->a[$i]) {
            $temp = $this->a[$i];
            $this->a[$i] = $this->a[floor($i / 2)];
            $this->a[floor($i / 2)] = $temp;
            $i = floor($i / 2);
        }
        return true;
    }

    public function remove()
    {
        if ($this->count == 0)
            return false;
        $removeData = $this->a[1];
        $this->a[1] = $this->a[$this->count];
        $this->count--;
        $i = 1;  // 堆顶元素
        while (true) {
            $maxPos = $i;
            if ($i * 2 <= $this->count && $this->a[$i * 2] > $this->a[$i]) {
                $maxPos = 2 * $i;
            }
            if ($i * 2 + 1 <= $this->count && $this->a[$i * 2 + 1] > $this->a[$maxPos]) {
                $maxPos = 2 * $i + 1;
            }
            if ($maxPos == $i) {
                break;
            }
            $temp = $this->a[$i];
            $this->a[$i] = $this->a[$maxPos];
            $this->a[$maxPos] = $temp;
            $i = $maxPos;
        }
        return $removeData;
    }

    public function __toString()
    {
        return json_encode(array_values($this->a));
    }
}

$heap = new Heap();
$heap->insert(1);
$heap->insert(2);
$heap->insert(3);
$heap->insert(4);
$heap->insert(5);
$heap->insert(6);
$heap->insert(7);
echo $heap;
