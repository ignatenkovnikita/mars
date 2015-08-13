<?php

namespace Rover\Input;

class Plato {
	public function __construct(Coordinate $topCoordinate) {
		$this->_topCoordinate = $topCoordinate;
	}

	public function getTopCoordinate() {
		return $this->_topCoordinate;
	}

	public function getBottomCoordinate() {
		return new Coordinate(0, 0);
	}
}