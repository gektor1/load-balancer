<?php

namespace LoadBalancer\Algorithm;

class LowestLoad extends AlgorithmAbstract
{
    /**
     * 
     *  Selects the Worker with the lowest load, while also skipping busy Workers
     * 
     * @return \LoadBalancer\Worker\WorkerInterface|boolean
     */
    public function getWorker()
    {
        $tmp = [];
        $load = [];
        foreach ($this->workers as $worker) {
            if ($worker->isBusy()) {
                continue;
            }
            $load[] = $worker->getLoad();
            $tmp[$worker->getLoad()][] = $worker;
        }

        if (!empty($tmp)) {
            return $tmp[min($load)][0];
        } else {
            return false;
        }
    }
    
}