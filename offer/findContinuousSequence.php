<?php

/*
S = (a1 + an) * n / 2
n = an - a1 + 1

因为 a1 + an > an - a1 + 1
故 2S > n^2
得 n < (2S)^(1/2)

将 n 带入得：
2S = (an + a1) * ( an - a1 + 1)
设 2S = k * l
得 an = (k + l - 1) / 2; a1 = (k - l + 1) / 2
 */
function FindContinuousSequence($sum)
{
    $result = [];
    if ($sum >= 3) {
        $sum = $sum << 1;
        $m = sqrt($sum);
        for ($l = 2; $l <= $m; $l++) {
            if ($sum % $l == 0) {
                $k = $sum / $l;
                $low = $k - $l + 1;
                $high = $k + $l - 1;
                if (!(($low | $high) & 1)) {
                    $result[] = range($low >> 1, $high >> 1);
                }
            }
        }
    }

    return array_reverse($result);
}

// 滑动窗口
function FindContinuousSequence1($sum)
{
    $result = [];
    $low = 1;
    $high = $low + 1;
    while ($high > $low) {
        $cur = ($high + $low) * ($high - $low + 1) >> 1;
        switch ($cur <=> $sum) {
            case -1:
                $high++;
                break;
            case 0:
                $result[] = range($low, $high);
            case 1:
                $low++;
        }
    }

    return $result;
}
