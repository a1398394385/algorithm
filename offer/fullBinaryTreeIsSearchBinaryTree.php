<?php

function inOrder(array $numbers, int $current): array
{
    if (($current << 1) > count($numbers))
        return (array) $numbers[$current];
    return array_merge(
        inOrder($numbers, $current << 1),
        (array) $numbers[$current],
        inOrder($numbers, ($current << 1) + 1)
    );

    // return [
    //     ...inOrder($numbers, $current << 1),
    //     $numbers[$current],
    //     ...inOrder($numbers, ($current << 1) + 1)
    // ];
}

// error example
// $inputs = [10, 5, 15, 3, 11, 13, 18];
// right example
// $inputs = [10, 5, 15, 3, 7, 13, 18];
$inputs = explode(',', trim(fread(STDIN, 100000)));
array_unshift($inputs, 1);
unset($inputs[0]);
$inputs = inOrder($inputs, 1);
$count = count($inputs);
for ($i = 1; $i < $count; $i++) {
    if ($inputs[$i] < $inputs[$i - 1])
        exit('False');
}
exit('True');
