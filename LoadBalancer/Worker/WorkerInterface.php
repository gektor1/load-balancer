<?php

namespace LoadBalancer\Worker;

use LoadBalancer\Task\TaskInterface;

interface WorkerInterface {
    public function processTask(TaskInterface $task);
    public function isBusy() : bool;
    public function getLoad() : int;
}
