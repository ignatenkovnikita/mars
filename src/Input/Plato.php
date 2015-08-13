<?php

namespace Rover\Input;

use Rover\Exceptions\PlatoException;

class Plato
{

	private $_bottomCoordinates;

	private $_topCoordinate;

	public function __construct(Coordinate $topCoordinates) {
		$this->_bottomCoordinates = new Coordinate(0, 0);
		$this->_topCoordinate = $topCoordinates;
		if (!$this->_isValid()) {
			throw new PlatoException(
				sprintf("Plato area not valid. Coordinates of top corner is: x = %d, y = %d",
				$this->_topCoordinate->getX(), $this->_topCoordinate->getY())
			);
		}
	}

	private function _isValid() {
		return (
			($this->_topCoordinate->getX() > $this->_bottomCoordinates->getX())
			&& ($this->_topCoordinate->getY() > $this->_bottomCoordinates->getY())
		);
	}

	public function getTopCoordinate() {
		return $this->_topCoordinate;
	}

	public function getBottomCoordinate() {
		return new Coordinate(0, 0);
	}
}