<?php


// This is MountainArray's API interface.
// You should not implement it, or speculate about its implementation
class MountainArray
{
    public $data = [];

    public $count = 0;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function get($index)
    {
        $this->count += 1;
        if ($this->count >= 100)
            die("get 调用次数过多");
        return $this->data[$index];
    }
    public function length()
    {
        return count($this->data);
    }
}


class Solution
{
    /**
     * @param Integer $target
     * @param MountainArray $mountainArr
     * @return Integer
     */
    function findInMountainArray($target, $mountainArr)
    {
        $length = $mountainArr->length();
        $leftValue =  $mountainArr->get(0);
        $rightValue = $mountainArr->get($length - 1);
        if ($leftValue > $target && $rightValue > $target) return -1;
        return $this->dp(0, $leftValue, $length - 1, $rightValue, $mountainArr, $target);
    }

    /**
     * Undocumented function
     *
     * @param int $left
     * @param int $leftValue
     * @param int $right
     * @param int $rightValue
     * @param MountainArray $mountainArr
     * @param int $target
     * @return void
     */
    public function dp(int $left, int $leftValue, int $right, int $rightValue, $mountainArr, int $target): int
    {
        if ($left == $right)
            if ($leftValue == $target) return $left;
            else return -1;

        $mid = ($left + $right) >> 1;
        if ($mid == $left) {
            $midValue = $midLeftValue = $leftValue;
            $midRightValue = $rightValue;
        } else if ($mid == $right) {
            $midValue = $midRightValue = $leftValue;
            $midLeftValue = $rightValue;
        } else {
            $midValue = $mountainArr->get($mid);
            $midLeftValue = $mountainArr->get($mid - 1);
            $midRightValue = $mountainArr->get($mid + 1);
        }

        if ($midValue == $target) {
            if ($midLeftValue > $midValue && $leftValue <= $target) {
                $temp = $this->dp($left, $leftValue, $mid - 1, $midLeftValue, $mountainArr, $target);
                if ($temp == -1) return $mid;
                return min($mid, $temp);
            }
            return $mid;
        }

        if ($midValue < $target) {
            if ($midLeftValue <= $midValue && $midRightValue <= $midValue)
                return -1;
            if ($midRightValue > $midValue)
                return $this->dp($mid + 1, $midRightValue, $right, $rightValue, $mountainArr, $target);
            if ($midLeftValue > $midValue)
                return $this->dp($left, $leftValue, $mid - 1, $midLeftValue, $mountainArr, $target);
            return -1;
        }

        if ($midValue > $target) {
            if ($leftValue <= $target) {
                $temp = $this->dp($left, $leftValue, $mid - 1, $midLeftValue, $mountainArr, $target);
                if ($temp < PHP_INT_MAX && $temp != -1)
                    return $temp;
            }
            if ($rightValue <= $target)
                return $this->dp($mid + 1, $midRightValue, $right, $rightValue, $mountainArr, $target);
            return -1;
        }
    }
}

$array = new MountainArray([1, 2, 3, 4, 5, 3, 1]);
// $array = new MountainArray([0, 1, 2, 4, 2, 1]);
// $array = new MountainArray([0, 5, 3, 1]);
// $array = new MountainArray(
//     [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2]
// );
$array = new MountainArray(
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 100, 99, 98, 97, 96, 95, 94, 93, 92, 91, 90, 89, 88, 87, 86, 85, 84, 83, 82]
);
$test = new Solution();
var_dump($test->findInMountainArray(81, $array));
