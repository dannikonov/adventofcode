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

/*








 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2019 -d 1
 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2019 -d 2
 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2019 -d 3

 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2020 -d 1
 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2020 -d 2
 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2020 -d 3
 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2020 -d 4
 /usr/bin/php /home/dn/code/adventofcode/index.php -y 2020 -d 5


 *
 *
 *
 *
 */