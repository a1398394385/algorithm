<?php
require '../vendor/autoload.php';

function minNumberInRotateArray($rotateArray)
{
    $lenght = count($rotateArray);
    if ($lenght == 0)
        return 0;
    if ($lenght == 1)
        return $rotateArray[0];

    for ($i = 0; $i < $lenght - 1; $i++) {
        if ($rotateArray[$i] > $rotateArray[$i + 1])
            return $rotateArray[$i + 1];
        if ($i == $lenght - 2)
            return $rotateArray[0];
    }
}

function minNumberInRotateArray2($rotateArray)
{
    $lenght = count($rotateArray);
    if ($lenght == 0)
        return 0;
    if ($lenght == 1)
        return $rotateArray[0];

    $low = 0;
    $high = $lenght - 1;
    while ($low < $high) {
        $mid = floor(($high + $low) / 2);
        if ($rotateArray[$mid] > $rotateArray[$high]) {
            $low = $mid + 1;
        } elseif ($rotateArray[$mid] < $rotateArray[$high]) {
            $high = $mid;
        } else {
            $high -= 1;
        }
    }

    return $rotateArray[$low];
}


function rotateArrayGenerater(int $num = 8): array
{
    $result = [];
    $arr = range(1, $num);
    for ($i = 0; $i < $num; $i++) {
        $result[] = $arr;
        array_push($arr, array_shift($arr));
    }

    return $result;
}

$one = 10;
$two = 1000;
$num = (2 * 2 * 2 * 2 * 2 * 2 * 2 * 2 * 2 * 2) - 1;
$array = rotateArrayGenerater($num + 1);
while ($one--) {
    $start = microtime(true);
    $i = $two;
    while ($i--) {
        minNumberInRotateArray($array[$i & $num]);
    }
    printf("Used %s S " . PHP_EOL, microtime(true) - $start);

    $start = microtime(true);
    $i = $two;
    while ($i--) {
        minNumberInRotateArray2($array[$i & $num]);
    }
    printf("Used %s S\n" . PHP_EOL, microtime(true) - $start);
}
