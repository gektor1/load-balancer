<?php

namespace LoadBalancer\Algorithm;

class RoundRobin extends AlgorithmAbstract
{
    
    /**
     * 
     *  selects workers sequentially in a simple round-robin fashion, but it skips busy workers
     * 
     * @return \LoadBalancer\Worker\WorkerInterface|boolean
     */
    public function getWorker()
    {
        $tmp = [];
        foreach ($this->workers as $worker) {
            if ($worker->isBusy()) {
                continue;
            }
            $tmp[] = $worker;
        }
        
        if (!empty($tmp)) {
            return $tmp[round(rand(0, count($tmp) - 1))];
        } else {
            return false;
        }
    }

}