<?php

require '../vendor/autoload.php';

function maxInWindows($num, $size)
{
    if ($size == 0)
        return [];
    $list = new \SplDoublyLinkedList();
    $result = [];
    $count = count($num);
    for ($i = 0; $i < $count; $i++) {
        if ($i >= $size && $list->count() > 0 &&  $list->bottom() == $num[$i - $size])
            $list->shift();
        while ($list->count() > 0 && $list->top() < $num[$i])
            $list->pop();
        $list->push($num[$i]);
        $result[] = $list->bottom();
    }
    return array_slice($result, $size - 1);
}


// TODO:test
$array = [2, 3, 4, 2, 6, 2, 5, 1];
$result = maxInWindows($array, 3);
dd($result);
