<?php

namespace Rover\Input;


use Rover\Exceptions\RoverException;

/**
 * Class RoverPosition
 * Represents position and direction for the rover.
 * @package Rover\Input
 */
class RoverPosition
{

	const DIRECTION_NORTH = 'N';
	const DIRECTION_SOUTH = 'S';
	const DIRECTION_WEST = 'W';
	const DIRECTION_EAST = 'E';


	/* @var string */
	private $_direction;

	/* @var Coordinate */
	private $_coordinates;

	public function __construct(Coordinate $coordinates, $direction) {
		$this->_coordinates = $coordinates;

		$this->_direction = strtoupper(trim($direction));

		if (!$this->_isValidDirection()) {
			throw new RoverException('Not valid rover direction given. Direction is: ' . $direction);
		}
	}

	private function _isValidDirection($direction = null) {
		return in_array(!empty($direction) ? $direction : $this->_direction, $this->_getDirection());
	}


	/**
	 * Method return direction array or individual direction by $index
	 * @param null|int $index
	 *
	 * @return array|string
	 */
	private function _getDirection($index = null) {
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

	/**
	 * Eval command against current position
	 * @param $command
	 *
	 * @return RoverPosition new Position
	 */
	public function evalCommand($command) {
		$newPosition = new RoverPosition(
			new Coordinate($this->_coordinates->getX(), $this->_coordinates->getY()), $this->getDirection()
		);

		if ($command == CommandSequence::TURN_LEFT || $command == CommandSequence::TURN_RIGHT) {

			$nextDirectionIndex = $this->_getCurrentDirectionIndex();

			if ($command == CommandSequence::TURN_RIGHT) {
				if ($nextDirectionIndex >= 3) {
					$nextDirectionIndex = 0;
				} else {
					$nextDirectionIndex++;
				}
			} else {
				if ($nextDirectionIndex <= 0) {
					$nextDirectionIndex = 3;
				} else {
					$nextDirectionIndex--;
				}
			}

			$newPosition->changeDirection($this->_getDirection($nextDirectionIndex));

		} else {
			if ($command == CommandSequence::MOVE_FORWARD) {
				if ($newPosition->getDirection() == self::DIRECTION_EAST) {
					$newPosition->getCoordinates()->moveAxis('x', 1);
				} else {
					if ($newPosition->getDirection() == self::DIRECTION_WEST) {
						$newPosition->getCoordinates()->moveAxis('x', -1);
					} else {
						if ($newPosition->getDirection() == self::DIRECTION_SOUTH) {
							$newPosition->getCoordinates()->moveAxis('y', -1);
						} else {
							if ($newPosition->getDirection() == self::DIRECTION_NORTH) {
								$newPosition->getCoordinates()->moveAxis('y', 1);
							}
						}
					}
				}
			}
		}

		return $newPosition;

	}


	private function _getCurrentDirectionIndex() {
		return array_search($this->_direction, $this->_getDirection());
	}


	public function getDirection() {
		return $this->_direction;
	}

	public function getCoordinates() {
		return $this->_coordinates;
	}


	public function changePosition(RoverPosition $newPosition) {
		$this->_coordinates = $newPosition->_coordinates;
		$this->_direction = $newPosition->_direction;
	}

	public function changeDirection($direction) {
		if ($this->_isValidDirection($direction)) {
			$this->_direction = $direction;
		}
	}
}