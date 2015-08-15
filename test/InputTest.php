<?php

use Rover\Input\CommandSequence;
use Rover\Exceptions\InvalidCommandSequenceException;

class InputTest extends PHPUnit_Framework_TestCase{

	public function testCommandSeqConstructor() {
		$c = new CommandSequence("LRLRM");
		$this->assertTrue(is_array($c->getSteps()));
	}


	public function testCommandSeqInvalidConstructor_One() {
		$this->setExpectedException('Rover\Exceptions\InvalidCommandSequenceException');
		$c = new CommandSequence(" L RLRM ");
	}

	public function testCommandSeqInvalidConstructor_Two() {
		$this->setExpectedException('Rover\Exceptions\InvalidCommandSequenceException');
		$c = new CommandSequence("LRMMLRLRMMLmmm");
	}



	public function testCoordInvalidConstructor() {
		$this->setExpectedException('Rover\Exceptions\InvalidCoordinatesException');
		$c = new \Rover\Input\Coordinate(0, 'a');
	}

	public function testCoordFloatConstructor() {
		$this->setExpectedException('Rover\Exceptions\InvalidCoordinatesException');
		$c = new \Rover\Input\Coordinate(1.2, 1.3);
	}

	public function testCoordCharConstructor() {
		$c = new \Rover\Input\Coordinate('1', '2');
		$this->assertTrue( $c->getX() == 1 && $c->getY() == 2 );

		$c = new \Rover\Input\Coordinate(0, 2);
		$this->assertTrue( $c->getX() == 0 && $c->getY() == 2 );
	}


	public function testRoverInvalidDirection() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		$c = new \Rover\Input\RoverPosition(new \Rover\Input\Coordinate(1,2),'Z');
	}


	public function testInvalidPlato() {
		$this->setExpectedException('Rover\Exceptions\PlatoException');
		new \Rover\Input\Plato(new \Rover\Input\Coordinate(0, 10));
	}



}