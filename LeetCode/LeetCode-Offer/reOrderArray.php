<?php

function reOrderArray($array)
{
    $lenght = count($array);
    //记录已经摆好位置的奇数的个数
    $oddNumber = 0;
    for ($i = 0; $i < $lenght; $i++) {
        if ($array[$i] & 1) {
            $j = $i;
            while ($j > $oddNumber) {
                $tmp = $array[$j];
                $array[$j] = $array[$j - 1];
                $array[$j - 1] = $tmp;
                $j--;
            }
            $oddNumber++;
        }
    }

    return $array;
}


// TODO: Wrong way
// function reOrderArray1(array $array)
// {
//     $lenght = count($array);
//     for ($odd = 0; $odd < $lenght; $odd++) {
//         if (($array[$odd] & 1) == 0) {
//             for ($even = $odd + 1; $even < $lenght; $even++) {
//                 if (($array[$even] & 1) == 1) {
//                     $temp = $array[$odd];
//                     $array[$odd] = $array[$even];
//                     $array[$even] = $temp;
//                     break;
//                 }
//             }
//         }
//     }

//     return $array;
// }

function reOrderArray2(array $array)
{
    $lenght = count($array) - 1;
    for ($i = 0; $i < $lenght; $i++) {
        for ($j = 0; $j < $lenght - $i; $j++) {
            if (!($array[$j] & 1) && ($array[$j + 1] & 1)) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }

    return $array;
}

$arr = [1, 2, 3, 4, 5, 6, 7];
// var_dump(reOrderArray1($arr));
