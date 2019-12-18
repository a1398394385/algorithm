<?php

function GetLeastNumbers_Solution($input, $k)
{
    $queue = new SplPriorityQueue();
    $result = [];
    foreach ($input as $value) {
        $queue->insert($value, $value);
    }
    $count = $queue->count();
    for ($i = 0; $i < $count && $count >= $k; $i++) {
        $value = $queue->extract();
        if ($i >= $count - $k)
            array_unshift($result, $value);
    }
    return $result;
}



// TODO:Test
$arr = [4, 5, 1, 6, 2, 7, 3, 8];
var_dump(GetLeastNumbers_Solution($arr, 4));
