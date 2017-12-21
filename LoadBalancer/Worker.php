<?php

namespace LoadBalancer;

use LoadBalancer\Worker\WorkerInterface;
use LoadBalancer\Task\TaskInterface;

class Worker implements WorkerInterface {

    public $busy = false;
    public $load = 0;

    public function processTask(TaskInterface $task) {
        $this->load++;
        $this->busy = true;
        $task->process($this);
        $this->busy = false;
    }

    public function isBusy() : bool {
        return $this->busy;
    }

    public function getLoad() : int {
        return $this->load;
    }

}
