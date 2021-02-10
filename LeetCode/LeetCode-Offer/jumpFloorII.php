<?php

function jumpFloorII($number)
{
    $result = 0;
    if ($number == 0)
        return 1;

    for ($i = 1; $i <= $number; $i++)
        $result += jumpFloorII($number - $i);

    return $result;
}



// TODO: TEST

$number  = (int) getopt('a:')['a'];

$start = microtime(true);
// while ($number--) {
echo jumpFloorII($number);
// }
printf("  Used %s S\n", microtime(true) - $start);
