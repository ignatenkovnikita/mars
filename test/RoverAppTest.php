<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 14.08.15
 * Time: 0:30
 */

class RoverAppTest extends PHPUnit_Framework_TestCase {

	public function testConfig() {
		$str =
"5 5
  1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM";

		$roverApp = new \Rover\RoverApp($str);
		$result  = $roverApp->processBatchCommand();

		$this->assertEquals("1 3 N\n5 1 E", $result);

	}


	public function testEmptyConfig() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		new \Rover\RoverApp('');
	}

	public function testEmptyLinesConfig() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		new \Rover\RoverApp("5 5\n1 2 N\nLLRR\n1 2 N\nLL\n\n\n\n1 2 N\nMMM");
	}

	public function testArrayConfig() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		new \Rover\RoverApp(array(1,2,3));
	}

	public function testSmallCountConfig() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		new \Rover\RoverApp("5 5\1 2 N");
	}

	public function testInvalidLinePositionConfig() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		new \Rover\RoverApp("5 5\LMLMLM\1 2 N");
	}

	public function testInvalidLinesConfig() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		new \Rover\RoverApp("5 5\n1 2 N\n");
	}


	public function testInvalidParamsConfig() {
		$this->setExpectedException('Rover\Exceptions\InvalidCommandSequenceException');
		$roverApp = new \Rover\RoverApp("5 5\n1 2 N\nLLRRTYTMMNN");
		$result  = $roverApp->processBatchCommand();

	}

	public function testInvalidNumLines() {
		$this->setExpectedException('Rover\Exceptions\RoverException');
		$roverApp = new \Rover\RoverApp("5 5\n1 2 N\nLLRR\n1 2 N");
		$roverApp->processBatchCommand();
	}
}