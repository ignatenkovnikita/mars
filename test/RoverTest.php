<?php

use Rover\Input\CommandSequence;
use Rover\Input\Coordinate;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;
use Rover\Rover;

class RoverTest extends PHPUnit_Framework_TestCase
{

	public function testRoverInput() {
		$position = new RoverPosition(new Coordinate(1, 2), RoverPosition::DIRECTION_NORTH);
		$commands = new CommandSequence('LMLMLMLMM');
		$plato = new Plato(new Coordinate(5, 5));

		$rover = new Rover($position, $commands, $plato);
		$rover->walk();

		$this->assertTrue(
			$rover->getPosition()->getCoordinates()->getX() == 1
			&& $rover->getPosition()->getCoordinates()->getY() == 3
			&& $rover->getPosition()->getDirection() == 'N'
		);


		$position = new RoverPosition(new Coordinate(3, 3), RoverPosition::DIRECTION_EAST);
		$commands = new CommandSequence('MMRMMRMRRM');
		$plato = new Plato(new Coordinate(5, 5));
		$rover = new Rover($position, $commands, $plato);
		$rover->walk();

		$this->assertTrue(
			$rover->getPosition()->getCoordinates()->getX() == 5
			&& $rover->getPosition()->getCoordinates()->getY() == 1
			&& $rover->getPosition()->getDirection() == 'E'
		);
	}


	public function testRoverInvalidWalk() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		$position = new RoverPosition(new Coordinate(0, 0), RoverPosition::DIRECTION_NORTH);
		$commands = new CommandSequence('LMMM');
		$plato = new Plato(new Coordinate(10, 10));

		$rover = new Rover($position, $commands, $plato);
		$rover->walk();
	}
}