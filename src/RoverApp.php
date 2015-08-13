<?php

namespace Rover;

use Rover\Input\RoverPosition;

class RoverApp {

	public static function getPosition(RoverPosition $position) {
		return sprintf('%d %d %s', $position->getX(), $position->getY(), $position->getDirection());
	}

	public function processBatchCommand($str) {
		//todo .. implement method
	}

	public function batchResult() {
		// todo implement methods
	}

}