<?php

function cutRope($number)
{
    if ($number <= 3)
        return $number - 1;
    switch ($number % 3) {
        case 0:
            return pow(3, $number / 3);
        case 1:
            return pow(3, ($number - 4) / 3) << 2;
        case 2:
            return pow(3, ($number - 2) / 3) << 1;
    }
}


// TODO:test
$number = fscanf(STDIN, '%d')[0];
echo cutRope($number);
