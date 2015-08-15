<?php

namespace Rover;

use Rover\Exceptions\RoverException;
use Rover\Input\CommandSequence;
use Rover\Input\Coordinate;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;

class Rover {

	/* @var RoverPosition */
	protected $_position;

	protected $_commands;

	protected $_plato;

	public function __construct(RoverPosition $position, CommandSequence $commands, Plato $plato) {
		$this->_position = $position;
		$this->_plato = $plato;
		$this->_commands = $commands;
	}

	public function getPosition() {
		return $this->_position;
	}

	public function walk() {
		foreach ($this->_commands->getSteps() as $step) {

			$newPosition = $this->_position->evalCommand($step);

			if (!$this->_isCoordinatesValid($newPosition->getCoordinates())) {
				throw new RoverException("Way is out from plato area. Last command is: ". $step .
					' Position X='.$this->_position->getCoordinates()->getX().
					', Y='. $this->_position->getCoordinates()->getY());
			} else {
				$this->_position->changePosition($newPosition);
			}
		}
	}

	public function _isCoordinatesValid(Coordinate $c) {
		$isXValid = $c->getX() >= $this->_plato->getBottomCoordinate()->getX()
		&& $c->getX() <= $this->_plato->getTopCoordinate()->getX();

		$isYValid =  $c->getY() >= $this->_plato->getBottomCoordinate()->getY()
			&& $c->getY() <= $this->_plato->getTopCoordinate()->getY();

		return $isXValid && $isYValid;
	}

} 