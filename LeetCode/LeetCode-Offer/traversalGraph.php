<?php
/*
题目描述
给定一张包含N个点、N-1条边的无向连通图，节点从1到N编号，每条边的长度均为1。
假设你从1号节点出发并打算遍历所有节点，那么总路程至少是多少？

输入描述:
第一行包含一个整数N，1≤N≤10^5。
接下来N-1行，每行包含两个整数X和Y，表示X号节点和Y号节点之间有一条边，1≤X，Y≤N。

输出描述:
输出总路程的最小值
@link https://www.nowcoder.com/practice/5427af99168b45f4a14aec195b28a839
*/

$nodeNum = fscanf(STDIN, '%d')[0];
$paths = [];
for ($i = $nodeNum; $i > 1; $i--) {
    $temp = fscanf(STDIN, '%d%d');
    if (isset($paths[$temp[0]]))
        array_push($paths[$temp[0]], $temp[1]);
    else
        $paths[$temp[0]] = [$temp[1]];
}

$distance = 0;
for ($sides = $paths[1]; !empty($sides); $distance++) {
    $temp = [];
    foreach ($sides as $side)
        if (isset($paths[$side]))
            array_push($temp, ...$paths[$side]);
    $sides = $temp;
}
echo (($nodeNum - 1) << 1) - $distance;
