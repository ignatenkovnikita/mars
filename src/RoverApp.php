<?php

namespace Rover;

use Rover\Input\RoverPosition;

class RoverApp {

	public static function getPosition(RoverPosition $position) {
		return sprintf('%d %d %s', $position->getY(), $position->getY(), $position->getDirection());
	}

}