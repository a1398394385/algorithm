<?php
/* 题目
 * 那时有位聪明的国王就设计出了一种与将军传递军事命令的暗号。
 * 国王事先与将军协定好几种数字组合(升序排列)及对应的军事暗号和破解方法:
 * 数字暗号:命令]
 * 0248:趁夜偷袭
 * 1357:按兵不动
 * 2678:立即撤退
 * ......
 * 某次军事行动，国王将-串密文"wgfieorzouhtrrot"写在纸条 上,并派亲信将纸条火速送至军营。将军打开纸条
 * 之后马上会意开始破译密文，很快就在纸条下方写下了破译后的明文0248 (zerotwofourright), 开始了筹备起夜
 * 晚的作战计划...
 * (注意:假设国王给出的密文永远都符合是小写字母组不会出现超出数字范畴不可达意的单词字母组合)
 * 根据将军在纸条上留下的破译后的明文数字作为线索，写-段程序可以帮助将军快速破译国王的密文所对应的
 * 数字暗号，并写下编程思路。
 */


function KingCode(string $code)
{
    $array = [
        'z' => 'zero',
        'w' => 'two',
        'u' => 'four',
        'x' => 'six',
        'g' => 'eight',
        'o' => 'one',
        'h' => 'three',
        'f' => 'five',
        's' => 'seven'
    ];
    $array = array_map(function ($value) {
        return str_split($value);
    }, $array);
    $count = array_count_values(str_split($code));
    $result = [];
    foreach ($array as $key => $valueArr) {
        if (isset($count[$key])) {
            $result[] = $valueArr;
            foreach ($valueArr as $value) {
                if (!isset($count[$value])) {
                    die('code error!');
                }
                $count[$value] -= 1;
                if ($count[$value] == 0) {
                    unset($count[$value]);
                }
            }
        }
    }

    if (!empty($count)) {
        $result[] = ['n', 'i', 'n', 'e'];
    }

    return $result;
}

function KingCode2(string $code)
{
    $array = [
        'z' => ['zero', 0],
        'w' => ['two', 2],
        'u' => ['four', 4],
        'x' => ['six', 6],
        'g' => ['eight', 8],
        'o' => ['one', 1],
        'h' => ['three', 3],
        'f' => ['five', 5],
        's' => ['seven', 7]
    ];
    $array = array_map(function ($value) {
        return [str_split($value[0]), $value[1]];
    }, $array);
    $count = array_count_values(str_split($code));
    $result = [];
    foreach ($array as $key => $valueArr) {
        if (isset($count[$key])) {
            $result[] = $valueArr[1];
            foreach ($valueArr[0] as $value) {
                if (!isset($count[$value]))
                    die('code error!');
                $count[$value] -= 1;
                if ($count[$value] == 0)
                    unset($count[$value]);
            }
        }
    }

    if (!empty($count)) {
        $result[] = 9;
    }

    return $result;
}

/**
 * wgfieorzouhtreot
 * zerotwofoureight
 */

$code = 'wgfieorzouhtreot';
var_dump(KingCode2($code));
