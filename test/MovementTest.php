<?php


use Rover\Input\Coordinate;
use Rover\Input\RoverPosition;

class MovementTest extends PHPUnit_Framework_TestCase
{

	public function testTurns() {
		$d = new RoverPosition(new Coordinate(1, 2), 'N');
		$d->processCommand('L');
		$d->processCommand('L');

		$this->assertEquals($d->getDirection(), RoverPosition::DIRECTION_SOUTH);


		$d = new RoverPosition(new Coordinate(1, 2), 'S');
		$d->processCommand('L');
		$d->processCommand('L');
		$d->processCommand('L');
		$d->processCommand('L');
		$this->assertEquals($d->getDirection(), RoverPosition::DIRECTION_SOUTH);


		$d = new RoverPosition(new Coordinate(1, 2), 'W');
		$d->processCommand('R');
		$d->processCommand('R');
		$d->processCommand('L');
		$this->assertEquals($d->getDirection(), RoverPosition::DIRECTION_NORTH);


		$d = new RoverPosition(new Coordinate(1, 2), 'E');
		$d->processCommand('R');
		$d->processCommand('R');
		$d->processCommand('R');
		$this->assertEquals($d->getDirection(), RoverPosition::DIRECTION_NORTH);
	}

	public function testMovement() {
		$d = new RoverPosition(new Coordinate(1, 2), 'E');
		$d->processCommand('M');
		$this->assertTrue($d->getCoordinates()->getX() == 2 && $d->getCoordinates()->getY() == 2);

		$d = new RoverPosition(new Coordinate(1, 2), 'W');
		$d->processCommand('M');
		$this->assertTrue($d->getCoordinates()->getX() == 0 && $d->getCoordinates()->getY() == 2);

		$d = new RoverPosition(new Coordinate(1, 2), 'S');
		$d->processCommand('M');
		$this->assertTrue($d->getCoordinates()->getX() == 1 && $d->getCoordinates()->getY() == 1);

		$d = new RoverPosition(new Coordinate(1, 2), 'N');
		$d->processCommand('M');
		$this->assertTrue($d->getCoordinates()->getX() == 1 && $d->getCoordinates()->getY() == 3);
	}

}