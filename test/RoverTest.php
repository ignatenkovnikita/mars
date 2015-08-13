<?php


use Rover\Input\CommandSequence;
use Rover\Input\RoverPosition;
use Rover\Rover;

class RoverTest extends PHPUnit_Framework_TestCase {

	public function testRoverInput() {
		$position = new RoverPosition(1, 2, RoverPosition::DIRECTION_NORTH);
		$commands = new CommandSequence('LMLMLMLMM');
		$rover = new Rover($position, $commands);
		$rover->walk();

		$this->assertTrue(
			$rover->getPosition()->getX() == 3 &&
			$rover->getPosition()->getY() == 3 &&
			$rover->getPosition()->getDirection() == 'E'
		);
	}
}