<?php

namespace LoadBalancer\Task;

use LoadBalancer\Worker\WorkerInterface;

interface TaskInterface {

    public function process();
}
