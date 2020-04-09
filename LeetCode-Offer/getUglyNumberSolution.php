<?php

/**
 * 题目描述
 * 把只包含质因子2、3和5的数称作丑数（Ugly Number）。
 * 例如6、8都是丑数，但14不是，因为它包含质因子7。
 * 习惯上我们把1当做是第一个丑数。求按从小到大的顺序的第N个丑数。
 * 1, 2, 3, 4, 5, 6, 8, 9, 10, 12, 15, 16, 18, 20, 24, 25, 27, 30, 32, 36
 */

/**
 * 获取丑数
 *
 * @param int $index
 * @return int
 */
function GetUglyNumber_Solution($index)
{
    if ($index <= 6)
        return $index;
    $result[0] = 1;
    $p2 = $p3 = $p5 = 0;
    for ($i = 1; $i < $index; $i++) {
        $result[$i] = min(
            $result[$p2] << 1,
            $result[$p3] + ($result[$p3] << 1),
            $result[$p5] + ($result[$p5] << 2)
        );
        if ($result[$i] == $result[$p2] << 1)
            $p2 += 1;
        if ($result[$i] == $result[$p3] + ($result[$p3] << 1))
            $p3 += 1;
        if ($result[$i] == $result[$p5] + ($result[$p5] << 2))
            $p5 += 1;
    }

    return $result[$index - 1];
}


// TODO:Test
echo GetUglyNumber_Solution(10);
