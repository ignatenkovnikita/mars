<?php

namespace Rover\Input;


class RoverPosition extends Coordinate {

	const DIRECTION_NORTH = 'N';
	const DIRECTION_SOUTH = 'S';
	const DIRECTION_WEST = 'W';
	const DIRECTION_EAST = 'E';

	/* @var string */
	protected $_direction;

	public function __construct($x, $y, $direction) {
		$this->_direction = strtoupper(trim($direction));

		if (!$this->_isValidDirection()) {
			throw new \Exception('asdasd');
		}

		parent::__construct($x, $y);
	}


	public function getDirection() {
		return $this->_direction;
	}

	private function _allDirections($index = null) {
		$allDirections = array(
			0 => self::DIRECTION_NORTH,
			1 => self::DIRECTION_EAST,
			2 => self::DIRECTION_SOUTH,
			3 => self::DIRECTION_WEST
		);

		if ($index !== null && array_key_exists($index, $allDirections)) {
			return $allDirections[$index];
		} else {
			return $allDirections;
		}
	}

	private function _getCurrentDirectionIndex() {
		return array_search($this->_direction, $this->_allDirections());
	}

	private function _isValidDirection() {
		return in_array($this->_direction, $this->_allDirections());
	}

	public function processCommand($command) {
		if ($this->_isValidDirection($command)) {
			if ($command == CommandSequence::TURN_LEFT || $command == CommandSequence::TURN_RIGHT) {
				// change direction
				$currentIndex = $this->_getCurrentDirectionIndex();

				if ($command == CommandSequence::TURN_RIGHT) {
					if ($currentIndex >= 3) {
						$currentIndex = 0;
					} else {
						$currentIndex++;
					}
					//++
				} else {
					//--
					if ($currentIndex <= 0) {
						$currentIndex = 3;
					} else {
						$currentIndex--;
					}
				}

				$this->_direction = $this->_allDirections($currentIndex); ////todo непонятно из кода, возможно сделать getDirectionByIndex метод

			} else if ($command == CommandSequence::MOVE_FORWARD) {
				if ($this->_direction == self::DIRECTION_EAST) {
					$this->_x++;
				} else if ($this->_direction == self::DIRECTION_WEST) {
					$this->_x--;
				} else if ($this->_direction == self::DIRECTION_SOUTH) {
					$this->_y--;
				} else if ($this->_direction == self::DIRECTION_NORTH) {
					$this->_y++;
				}
			}
		}
	}
}