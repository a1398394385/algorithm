<?php

function IsPopOrder($pushV, $popV)
{
    $count = count($pushV);
    if ($count == 0)
        return false;
    $stack = [];
    for ($i = 0, $j = 0; $i < $count; $i++) {
        array_push($stack, $pushV[$i]);
        while ($j < $count && end($stack) == $popV[$j]) {
            array_pop($stack);
            $j++;
        }
    }

    return empty($stack);
}
