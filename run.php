<?php

require './vendor/autoload.php';

use LoadBalancer\LoadBalancer;
use LoadBalancer\Worker;
use LoadBalancer\Task;

$workers = [];
$w = 0;
while($w < 5) {
    $workers[] = new Worker();
    $w++;
}

$tasks = [];
$t = 0;
while($t < 10) {
    $tasks[] = new Task($t);
    $t++;
}

foreach (['LowestLoad' , 'RoundRobin'] as $balancingAlgorithm) {
    echo $balancingAlgorithm . PHP_EOL;
    
    $balancer = new LoadBalancer($workers, $balancingAlgorithm);

    foreach ($tasks as $task) {
        $balancer->processTask($task);
    }

    $i = 1;
    foreach ($balancer->getWorkers() as $worker) {
        echo 'Worker #' . $i . ' task processed: ' . $worker->getLoad() . PHP_EOL;
        $i++;
    }
}
