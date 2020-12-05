<?php

require_once __DIR__ . '/vendor/autoload.php';

$options = getopt("y:d:");

$solution_factory = new Common\Solution($options["y"], $options["d"]);

$task = $solution_factory->get_solution();

echo "anwser 1: " . $task->solution_1();
echo "\n";
echo "anwser 2: " . $task->solution_2();
echo "\n";
$task->answer();