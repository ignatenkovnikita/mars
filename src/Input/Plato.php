<?php

namespace Rover\Input;

class Plato {
	public function __construct(Coordinate $topCoordinates) {
		$this->_topCoordinate = $topCoordinates;
	}

	public function getTopCoordinate() {
		return $this->_topCoordinate;
	}

	public function getBottomCoordinate() {
		return new Coordinate(0, 0);
	}
}