<?php

namespace LoadBalancer;

use LoadBalancer\Worker\WorkerInterface;
use LoadBalancer\Task\TaskInterface;

class LoadBalancer {

    private $workers = [];
    private $balancingAlgorithm;

    /**
     * 
     * Init workers and set balancing algorithm
     * 
     * @param array $workers
     * @param string $balancingAlgorithm
     */
    public function __construct(array $workers, $balancingAlgorithm) {
        $this->workers = $workers;
        $balancingAlgorithmClass = 'LoadBalancer\Algorithm\\' . $balancingAlgorithm;
        $this->balancingAlgorithm = new $balancingAlgorithmClass($this->workers);
    }

    /**
     * 
     * Pass task to worker instances based on the selected load balancing algorithm
     * 
     * @param TaskInterface $task
     * @return mixed
     */
    public function processTask(TaskInterface $task) {
        while ($worker = $this->getBalancingAlgorithm()->getWorker()) {
            if ($worker !== false) {
                return $worker->processTask($task);
            }
        }
    }

    /**
     * Get balancing algorithm instance
     * 
     * @return Algorithm\AlgorithmInterface
     */
    private function getBalancingAlgorithm() {
        return $this->balancingAlgorithm;
    }
    
    /**
     * Get worker list
     * 
     * @return array
     */
    public function getWorkers() {
        return $this->workers;
    }
    
}
