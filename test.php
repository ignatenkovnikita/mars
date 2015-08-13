<?php

require_once('vendor/autoload.php');

use Rover\RoverApp;

$app = new RoverApp();

$str =
	"5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM";

echo $app->processBatchCommand($str);