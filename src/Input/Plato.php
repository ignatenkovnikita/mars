<?php

namespace Rover\Input;

class Plato {
	public function __construct($x, $y) {
		$this->_topCoordinate = new Coordinate($x, $y);
	}

	public function getTopCoordinate() {
		return $this->_topCoordinate;
	}

	public function getBottomCoordinate() {
		return new Coordinate(0, 0);
	}
}