package main

import (
	"time"
	"fmt"
)

func main() {
    for i := 0; i < 10; i++ {
        now := time.Now().UnixNano()
        movingCount(1500, 2000, 2000)
        fmt.Printf("Used: %v\n", (time.Now().UnixNano() - now) / 1e6)

        now = time.Now().UnixNano()
        movingCount1(1500, 2000, 2000)
        fmt.Printf("Used: %v\n\n", (time.Now().UnixNano() - now) / 1e6)
    }
}

func sum(num int) int {
    result := 0
    for num != 0 {
        result += num % 10
        num = num / 10
    }
    return result
}

func movingCount(threshold, rows, cols int) int {
    result := 0
    temp := threshold
    cap := 1
    for temp != 0 {
        cap *= 10
        temp = temp / 10
    }
    for i := 0; i < rows; i++ {
        temp = sum(i)
        for j := 0; j < cols; j++ {
            if temp + sum(j) <= threshold {
                result++
            }
        }
    }
    return result
}

func movingCount1(threshold, rows, cols int) int {
    var flag [10000][10000]uint8
    return helper(0, 0, rows, cols, threshold, &flag)
}

func helper(i, j, rows, cols, threshold int, flag *[10000][10000]uint8) int {
        if (i >= rows || j >= cols || sum(i) + sum(j)  > threshold || (*flag)[i][j] == 1) {
            return 0
        }
        (*flag)[i][j] = 1;
        return helper(i + 1, j, rows, cols, threshold, flag) + helper(i, j + 1, rows, cols, threshold, flag) + 1
}

