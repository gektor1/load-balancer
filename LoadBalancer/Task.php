<?php

namespace LoadBalancer;

use LoadBalancer\Task\TaskInterface;

class Task implements TaskInterface {

    private $id;
    
    public function __construct($id) {
        $this->id = $id;
    }
    
    public function process() {
        //action here
        echo sprintf('Task %s processed', $this->id) . PHP_EOL;
    }

}
