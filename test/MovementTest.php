<?php


use Rover\Input\Coordinate;
use Rover\Input\RoverPosition;

class MovementTest extends PHPUnit_Framework_TestCase
{

	public function testTurns() {
		$initStates = array(
			RoverPosition::DIRECTION_NORTH,
			RoverPosition::DIRECTION_WEST,
			RoverPosition::DIRECTION_SOUTH,
			RoverPosition::DIRECTION_EAST,
		);

		$resultStatesLeft = array(
			RoverPosition::DIRECTION_WEST,
			RoverPosition::DIRECTION_SOUTH,
			RoverPosition::DIRECTION_EAST,
			RoverPosition::DIRECTION_NORTH,
		);

		$resultStatesRight = array(
			RoverPosition::DIRECTION_EAST,
			RoverPosition::DIRECTION_NORTH,
			RoverPosition::DIRECTION_WEST,
			RoverPosition::DIRECTION_SOUTH,
		);

		foreach ($initStates as $i => $state) {
			$d = new RoverPosition(new Coordinate(1, 2), $state);
			$newPosition = $d->evalCommand('L');
			$this->assertEquals($newPosition->getDirection(), $resultStatesLeft[$i]);
		}

		foreach ($initStates as $i => $state) {
			$d = new RoverPosition(new Coordinate(1, 2), $state);
			$newPosition = $d->evalCommand('R');
			$this->assertEquals($newPosition->getDirection(), $resultStatesRight[$i]);
		}
	}

	public function testMovement() {
		$d = new RoverPosition(new Coordinate(1, 2), 'E');
		$newPosition = $d->evalCommand('M');
		$this->assertTrue($newPosition->getCoordinates()->getX() == 2 && $newPosition->getCoordinates()->getY() == 2);

		$d = new RoverPosition(new Coordinate(1, 2), 'W');
		$newPosition = $d->evalCommand('M');
		$this->assertTrue($newPosition->getCoordinates()->getX() == 0 && $newPosition->getCoordinates()->getY() == 2);

		$d = new RoverPosition(new Coordinate(1, 2), 'S');
		$newPosition = $d->evalCommand('M');
		$this->assertTrue($newPosition->getCoordinates()->getX() == 1 && $newPosition->getCoordinates()->getY() == 1);

		$d = new RoverPosition(new Coordinate(1, 2), 'N');
		$newPosition = $d->evalCommand('M');
		$this->assertTrue($newPosition->getCoordinates()->getX() == 1 && $newPosition->getCoordinates()->getY() == 3);
	}

}