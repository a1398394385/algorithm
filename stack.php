<?php

/**
 * 通过 PHP 数组实现简单的顺序栈
 */
class SimpleStack {

    private $_stack = [];
    private $_size = [];

    public function __construct($size = 10)
    {
        $this->_size = $size;
    }

    // 获取栈顶元素
    public function pop()
    {
        // 空栈
        if (count($this->_stack) == 0) {
            return false;
        }
        return array_pop($this->_stack);
    }

    // 推送元素到栈顶
    public function push($value)
    {
        // 满栈
        if (count($this->_stack) == $this->_size) {
            return false;
        }
        array_push($this->_stack, $value);
        return true;
    }

    public function isEmpty()
    {
        // 是否是空栈
        return current($this->_stack) == false;
    }

    public function size()
    {
        return count($this->_size);
    }
}

$stack = new SimpleStack(15);
var_dump($stack->isEmpty());  # true
$stack->push(111);
$stack->push('学院君');
var_dump($stack->pop());  # 学院君
var_dump($stack->size());  # 1