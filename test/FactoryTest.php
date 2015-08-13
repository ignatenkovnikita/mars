<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 14.08.15
 * Time: 2:41
 */

class FactoryTest extends PHPUnit_Framework_TestCase {

	public function testCoordFactory() {
		$coords = \Rover\Factory\CoordinatesFactory::create(' 1 10  ');
		$this->assertInstanceOf('\Rover\Input\Coordinate', $coords);
	}

	public function testInvalidCoordFactory() {
		$this->setExpectedException('Rover\Exceptions\RoverFactoryException');
		\Rover\Factory\CoordinatesFactory::create('1 10 5');
	}

	public function testInvalidCoordCharFactory() {
		$this->setExpectedException('Rover\Exceptions\InvalidCoordinatesException');
		\Rover\Factory\CoordinatesFactory::create('1 a');
	}


	public function testPositionFactory() {
		$pos = \Rover\Factory\RoverPositionFactory::create('1 10 W');
		$this->assertInstanceOf('\Rover\Input\RoverPosition', $pos);
	}

	public function testInvalidPositionFactory() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		\Rover\Factory\RoverPositionFactory::create('1 10 L');
	}

	public function testArgsPositionFactory() {
		$this->setExpectedException('Rover\Exceptions\RoverFactoryException');
		\Rover\Factory\RoverPositionFactory::create('1 10');
	}

}