<?php

namespace LoadBalancer\Algorithm;

class AlgorithmAbstract
{
    protected $workers;
    
    public function __construct($workers)
    {
        $this->workers = $workers;
    }
    
    

}