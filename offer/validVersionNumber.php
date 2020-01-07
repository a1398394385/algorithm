<?php
/*
题目描述
现在给出一棵树，树的结点名字表示项目的名称和版本号，用逗号分隔，例如结点名字为a,1表示项目的名称为a，版本号为1。
每个结点的名字都是唯一的。但树里可以出现项目名称相同，但版本号不同的结点。
对于某个名称的项目来说，真正有效的版本号是距离根节点最近的是这个项目名称的结点里的版本号。
如果多个相同项目名称，不同版本的结点距离根节点的距离相同，则生效版本为在输入中先出现的结点的版本。
此外，输入中给出的依赖关系可能存在循环依赖的例外情况，例如a,1依赖b,1，b,1又依赖a,1，这种情况就不是一颗有效的树。

input description:
输入由多行组成。
第一行是要检查的项目的名称，要检查的项目必定会存在于输入中。
第二行是根节点的项目名称及版本号。
接下来每行表示两个项目之间的依赖关系。用->表示前者依赖后者，即后者是前者的子节点。
例如a,1->b,1，表示1版本的a依赖1版本的b。
结点名字由项目名称和版本号组成，用逗号分隔，项目名称是a-z的单个字符，版本号是1-9的正整数。

output description:
如果给的输入能组成一颗有效的树，则输出要检查的项目的生效版本号。
如果给的输入不能组成一颗有效的树，则输出-1。

example(1):
input:
e
a,1
b,1->e,2
c,1->e,1
a,1->b,1
a,1->c,1
a,1->d,1

output:
2

example(2):
input:
b
a,1
a,1->b,1
a,1->c,1
d,1->a,1
b,1->d,1

output:
-1
 */


// TODO:Test
$input = trim(fgets(STDIN));
while ($input !== "") {
    $inputs[] = $input;
    $input = trim(fgets(STDIN));
}
$findNode = array_shift($inputs);
$rootNode = array_shift($inputs);
$inputs = array_map(function ($value) {
    return explode('->', $value);
}, $inputs);

$findNodes = [];
$array = [];
foreach ($inputs as $value) {
    $array[$value[1]]['father'] = $value[0];
    $array[$value[0]]['children'][$value[1]] = 1;
    $father = $value[1];
    for ($father = $value[1]; isset($array[$father]['father']); $father = $array[$father]['father'])
        if ($value[1] == $array[$father]['father'])
            exit('-1');

    foreach ($value as $val)
        if (preg_match('/^' . $findNode . '/', $val))
            $findNodes[] = $val;
}

$result = [];
foreach ($findNodes as $node) {
    $distance = 0;
    $temp = $node;
    for (; isset($array[$temp]['father']); $distance++)
        $temp = $array[$temp]['father'];
    $result[$node] = $distance;
}
asort($result);
echo explode(',', key($result))[1];
