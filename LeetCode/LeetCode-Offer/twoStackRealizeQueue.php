<?php

$stack1 = new SplStack;
$stack2 = new SplStack;

/**
 * 剑指 Offer 09
 * 用两个栈实现队列
 */
function mypush($node)
{
    global $stack1;
    global $stack2;

    if (!$stack2->isEmpty()) {
        while (!$stack2->isEmpty()) {
            $stack1->push($stack2->pop());
        }
    }
    $stack1->push($node);

    return $stack1->bottom();
}

function mypop()
{
    global $stack1;
    global $stack2;

    if (!$stack1->isEmpty()) {
        while (!$stack1->isEmpty()) {
            $stack2->push($stack1->pop());
        }
    }

    if ($stack2->isEmpty())
        return false;

    return $stack2->pop();
}

mypush(1);
mypush(2);
echo mypop() . PHP_EOL;
mypush(3);
mypush(4);
echo mypop();
echo mypop();
echo mypop();
