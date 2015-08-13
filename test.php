<?php

require_once('vendor/autoload.php');

use Rover\RoverApp;



$str =
	"5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM";

$str = "5 5\n1 2 N\nLLRR\n1 2 N";
$app = new RoverApp($str);

echo $app->processBatchCommand($str);