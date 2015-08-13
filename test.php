<?php

require_once('vendor/autoload.php');

use Rover\Input;
use Rover\RoverApp;

$app = new RoverApp();
$app->processBatchCommand($str);
$app->batchResult();