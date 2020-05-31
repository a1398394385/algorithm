<?php
/*
 * DJBX33A (Daniel J. Bernstein, Times 33 with Addition)
 *
 * This is Daniel J. Bernstein's popular `times 33' hash function as
 * posted by him years ago on comp.lang.c. It basically uses a function
 * like ``hash(i) = hash(i-1) * 33 + str[i]''. This is one of the best
 * known hash functions for strings. Because it is both computed very
 * fast and distributes very well.
 *
 * The magic of number 33, i.e. why it works better than many other
 * constants, prime or not, has never been adequately explained by
 * anyone. So I try an explanation: if one experimentally tests all
 * multipliers between 1 and 256 (as RSE did now) one detects that even
 * numbers are not usable at all. The remaining 128 odd numbers
 * (except for the number 1) work more or less all equally well. They
 * all distribute in an acceptable way and this way fill a hash table
 * with an average percent of approx. 86%.
 *
 * If one compares the Chi^2 values of the variants, the number 33 not
 * even has the best value. But the number 33 and a few other equally
 * good numbers like 17, 31, 63, 127 and 129 have nevertheless a great
 * advantage to the remaining numbers in the large set of possible
 * multipliers: their multiply operation can be replaced by a faster
 * operation based on just one shift plus either a single addition
 * or subtraction operation. And because a hash function has to both
 * distribute good _and_ has to be very fast to compute, those few
 * numbers should be preferred and seems to be the reason why Daniel J.
 * Bernstein also preferred it.
 *
 *
 *                  -- Ralf S. Engelschall <rse@engelschall.com>
 */

namespace HashTable;

/**
 * Gets the hash value of the string
 *
 * @param string $str
 * @return int
 * @author XiaoYunSong
 */
function getHash(string $str)
{
    $hash   = 5381;
    $arr    = str_split($str);                  // string to array
    $arr    = array_map(function ($value) {     // char to ASCII
        return ord($value);
    }, $arr);
    $length = count($arr);
    $index  = $length - 1;

    while ($length >= 8) {
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;   // We only need the lower 32 bits
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $hash   = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        $length -= 8;
    }

    switch ($length) {
        case 7:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        case 6:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        case 5:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        case 4:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        case 3:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        case 2:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
        case 1:
            $hash = (($hash + ($hash << 5)) + $arr[$index--]) & 0xFFFFFFFF;
            break;
        case 0:
            break;
    }

    return $hash;
}
// bindec(substr(decbin((($hash + ($hash << 5)) + $arr[$index--])), -32, 32));

/**
 * old hash fuctiong
 *
 * @param string $str
 * @return int
 * @author XiaoYunSong
 */
function hash_fun(string $str)
{
    $hash   = 5381;
    $arr    = str_split($str);
    $arr    = array_map(function ($value) {
        return ord($value);
    }, $arr);
    $length = count($arr);
    $index  = $length - 1;

    while ($length >= 8) {
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $hash   = (($hash << 5) + $hash) + $arr[$index--];
        $length -= 8;
    }

    switch ($length) {
        case 7:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
        case 6:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
        case 5:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
        case 4:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
        case 3:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
        case 2:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
        case 1:
            $hash = (($hash << 5) + $hash) + $arr[$index--];
            break;
        case 0:
            break;
    }

    return $hash;
}
