<?php

class Boos
{

    //领导依赖员工
    private $staff;

    //老板只需要告诉外部我需要什么样的人就好了，其它什么都不管，具体什么样的人交给外部处理。
    //用构造方法方式实现依赖注入
    public function __construct(Standard $staff)
    {
        $this->staff = $staff;
    }

    public function task()
    {
        $this->staff->work();
    }
}

//招聘所设定的标准
interface Standard
{
    public function work();
}

class StaffA implements Standard
{
    public function work()
    {
        echo '雇员A有能力能够完成老板指定的工作';
    }
}

class StaffB implements Standard
{
    public function work()
    {
        echo '雇员B有能力能够完成老板指定的工作';
    }
}

class Hr
{

    private $binds = [];

    //接受不同员工的简历，并存起来
    public function bind($contract, $concrete)
    {
        $this->binds[$contract] = $concrete;
    }

    //询问老板选人的标准由哪些,并且从满足的简历中筛选人
    private function methodBindParams($className)
    {
        $reflect = new reflect($className, '__construct');
        return $reflect->bindParamsToMethod();
    }

    //将选好的工作人员交给老板
    public function make($className)
    {
        $methodBindParams = $this->methodBindParams($className);
        $reflect = new reflect($className, '__construct');
        return $reflect->make($this->binds, $methodBindParams);
    }
}


class reflect
{
    private $className;

    private $methodName;

    public function __construct($className, $methodName)
    {
        $this->className = $className;
        $this->methodName = $methodName;
    }

    /**
     * 返回被注入实例的 __construct 所需的 params 及其对应 class
     */
    public function bindParamsToMethod()
    {
        $params = [];

        $method  = new ReflectionMethod($this->className, $this->methodName);

        foreach ($method->getParameters() as $param) {
            $params[] =  [$param->name, $param->getClass()->name];
        }

        return [$this->className => $params];
    }

    /**
     * 构造依赖注入所需要的实例
     */
    public function make($bind, $methodBindParams)
    {
        $args = [];
        foreach ($methodBindParams as $className => $params) {
            foreach ($params as $param) {
                list($paramName, $paramType) = $param;

                $paramName = new $bind[$paramType]();

                array_push($args, $paramName);
            }
        }
        $reflectionClass = new ReflectionClass($this->className);
        return $reflectionClass->newInstanceArgs($args);
    }
}
$hr = new Hr();

//老板如果需要换工作人员，只需要绑定其它的工作人员即可。
$staff = $hr->bind('Standard', 'StaffA');

$boos = $hr->make('Boos');

$boos->task();
