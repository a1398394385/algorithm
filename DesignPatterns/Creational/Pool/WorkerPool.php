<?php

declare(strict_types=1);

namespace DesignPatterns\Creational\Pool;

use Countable;

/**
 * 对象池（也称为资源池）被用来管理对象缓存,对象池是一组已经初始化过且可以直接使用的对象集合
 * 用户在使用对象时可以从对象池中获取对象，对其进行操作处理,并在不需要时归还给对象池而非销毁它
 * 若对象初始化、实例化的代价高，且需要经常实例化，但每次实例化的数量较少的情况下，使用对象池可以获得显著的性能提升
 * 常见的使用对象池模式的技术包括线程池、数据库连接池、任务队列池、图片资源对象池等
 * 当然，如果要实例化的对象较小，不需要多少资源开销，就没有必要使用对象池模式了，这非但不会提升性能，反而浪费内存空间，甚至降低性能。
 */
class WorkerPool implements Countable
{
    /**
     * @var StringReverseWorker[]
     */
    private array $occupiedWorkers = [];

    /**
     * @var StringReverseWorker[]
     */
    private array $freeWorkers = [];

    public function get(): StringReverseWorker
    {
        if (count($this->freeWorkers) == 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose(StringReverseWorker $worker)
    {
        $key = spl_object_hash($worker);

        if (isset($this->occupiedWorkers[$key])) {
            unset($this->occupiedWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }

    public function count(): int
    {
        return count($this->occupiedWorkers) + count($this->freeWorkers);
    }
}
