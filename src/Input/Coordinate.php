<?php

namespace Rover\Input;

use Rover\Exceptions\InvalidCoordinatesException;

class Coordinate {

	protected $_x;

	protected $_y;

	public function __construct($x, $y) {
		if ($this->_isValid($x, $y)) {
			$this->_x = $x*1;
			$this->_y = $y*1;
		} else {
			throw new InvalidCoordinatesException("Not valid coordinates. x = $x, y = $y");
		}
	}

	private function _isValid($x, $y) {
		return ( ($this->_isNumber($x) && $this->_isNumber($y)) && ($x >=0 && $y >= 0));
	}

	private function _isNumber($val) {
		return preg_match('/^\d+$/', $val);
	}


	public function getX() {
		return $this->_x;
	}

	public function getY() {
		return $this->_y;
	}


	/**
	 * Moves x or y to $number steps
	 * @param $axis
	 * @param $number
	 */
	public function moveAxis($axis, $number) {
		$property = '_'.$axis;
		$this->{$property} = $this->{$property} + $number;
	}



}
