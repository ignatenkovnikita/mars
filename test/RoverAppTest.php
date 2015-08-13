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

		$roverApp = new \Rover\RoverApp();
		$result  = $roverApp->processBatchCommand($str);

		$this->assertEquals("1 3 N\n5 1 E", $result);

	}

}