<?php

require_once('vendor/autoload.php');

use Rover\RoverApp;



$str =
	"5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM";

$app = new RoverApp($str);

echo $app->processBatchCommand();
echo "\n";