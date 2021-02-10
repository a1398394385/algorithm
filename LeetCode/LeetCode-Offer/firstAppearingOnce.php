<?php

function Init(): void
{
    global $chars;
    $chars = [];
}

function Insert(string $ch): void
{
    global $chars;
    if (isset($chars[$ch]))
        $chars[$ch]++;
    else
        $chars[$ch] = 1;
}

function FirstAppearingOnce(): string
{
    global $chars;
    foreach ($chars as $char => $quantity)
        if ($quantity == 1)
            return $char;
    return '#';
}
