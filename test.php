<?php

require_once('vendor/autoload.php');

use Rover\Input;
use Rover\Input\CommandSequence;
use Rover\Input\Coordinate;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;
use Rover\Rover;
use Rover\RoverDispatcher;

/*$d = new RoverDispatcher();

$d->setPlatoCoordinates(5,5);
$d->addRover(new RoverPosition( 1, 2, RoverPosition::DIRECTION_NORTH), new CommandSequence('LMLMLMLMM'));

$d->start();*/

//$this->assertEquals($d->getDirection(), RoverPosition::DIRECTION_NORTH);
//$this->assertEquals($d->getDirection(), RoverPosition::DIRECTION_SOUTH);


$position = new RoverPosition(1, 2, RoverPosition::DIRECTION_NORTH);
$commands = new CommandSequence('LMLMLMLMM');
$rover = new Rover($position, $commands);
$rover->walk();

echo $rover->getPosition()->getX() ."<br />";
echo $rover->getPosition()->getY() ."<br />";
echo $rover->getPosition()->getDirection() ."<br />";
