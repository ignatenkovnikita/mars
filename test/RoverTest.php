<?php

use Rover\Input\CommandSequence;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;
use Rover\Rover;

class RoverTest extends PHPUnit_Framework_TestCase {

	public function testRoverInput() {
		$position = new RoverPosition(1, 2, RoverPosition::DIRECTION_NORTH);
		$commands = new CommandSequence('LMLMLMLMM');
		$plato = new Plato(5, 5);

		$rover = new Rover($position, $plato);
		$rover->walk($commands);

		$this->assertTrue(
			$rover->getPosition()->getX() == 1 &&
			$rover->getPosition()->getY() == 3 &&
			$rover->getPosition()->getDirection() == 'N'
		);


		$position = new RoverPosition(3, 3, RoverPosition::DIRECTION_EAST);
		$commands = new CommandSequence('MMRMMRMRRM');
		$plato = new Plato(5, 5);
		$rover = new Rover($position, $plato);
		$rover->walk($commands);

		$this->assertTrue(
			$rover->getPosition()->getX() == 5 &&
			$rover->getPosition()->getY() == 1 &&
			$rover->getPosition()->getDirection() == 'E'
		);
	}


	public function testRoverInvalidWalk() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		$position = new RoverPosition(0, 0, RoverPosition::DIRECTION_NORTH);
		$commands = new CommandSequence('LMMM');
		$plato = new Plato(10, 10);

		$rover = new Rover($position, $plato);
		$rover->walk($commands);
	}
}