<?php
/* class BMW
{
    public function run()
    {
        echo '宝马启动了！';
    }
    public function turn()
    {
        echo '宝马要转弯了！';
    }
    public function stop()
    {
        echo '宝马停车了！';
    }
}

class Benz
{
    public function run()
    {
        echo '奔驰启动了！';
    }
    public function turn()
    {
        echo '奔驰要转弯了！';
    }
    public function stop()
    {
        echo '奔驰停车了！';
    }
} */

/* class AutoDrive
{
    private $type;
    private $BMW;
    private $Benz;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->BMW  = new BMW();
        $this->Benz = new Benz();
    }

    public function autoRun()
    {
        if ($this->type == 'BMW') {
            $this->BMW->run();
        } else {
            $this->Benz->run();
        }
    }

    public function autoTurn()
    {
        if ($this->type == 'BMW') {
            $this->BMW->turn();
        } else {
            $this->Benz->turn();
        }
    }

    public function autoStop()
    {
        if ($this->type == 'BMW') {
            $this->BMW->stop();
        } else {
            $this->Benz->stop();
        }
    }
} */

/* class Volkswagen
{
    // run / turn / stop
}

class AutoDrive
{
    private $type;
    private $BMW;
    private $Benz;
    private $Volkswagen;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->BMW        = new BMW();
        $this->Benz       = new Benz();
        $this->Volkswagen = new Volkswagen();
    }

    public function autoRun()
    {
        if ($this->type == 'BMW') {
            $this->BMW->run();
        } else if ($this->type == 'Benz') {
            $this->Benz->run();
        } else {
            $this->Volkswagen->run();
        }
    }

    public function autoTurn()
    {
        if ($this->type == 'BMW') {
            $this->BMW->turn();
        } else if ($this->type == 'Benz') {
            $this->Benz->turn();*
        } else {
            $this->Volkswagen->turn();
        }
    }

    public function autoStop()
    {
        if ($this->type == 'BMW') {
            $this->BMW->stop();
        } else if ($this->type == 'Benz') {
            $this->Benz->stop();
        } else {
            $this->Volkswagen->stop();
        }
    }
}
 */

/**
 * 通过接口来实现低层模块的规范管理
 */
interface Car
{
    public function run();
    public function turn();
    public function stop();
}

/**
 * 低层模块必须实现接口
 */
class BMW implements Car
{
    public function run()
    {
        echo '宝马启动了！';
    }
    public function turn()
    {
        echo '宝马要转弯了！';
    }
    public function stop()
    {
        echo '宝马停车了！';
    }
}
class Benz implements Car
{
    // run / turn / stop
}
class Volkswagen implements Car
{
    // run / turn / stop
}

class AutoDrive
{
    private $car;

    // 高层模块通过接口实现与低层模块的连接
    public function __construct(Car $car)
    {
        $this->car = $car;
    }
    public function autoRun()
    {
        $this->car->run();
    }
    public function autoTurn()
    {
        $this->car->turn();
    }
    public function autoStop()
    {
        $this->car->stop();
    }
}
