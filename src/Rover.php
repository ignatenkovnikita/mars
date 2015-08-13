<?php

namespace Rover;

use Rover\Exceptions\RoverException;
use Rover\Input\CommandSequence;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;

class Rover {

	/* @var RoverPosition */
	protected $_position;

	protected $_commands;

	protected $_plato;

	public function __construct(RoverPosition $position, Plato $plato ) {
		$this->_position = $position;
		$this->_plato = $plato;
	}

	public function getPosition() {
		return $this->_position;
	}

	public function walk(CommandSequence $commands) {
		foreach ($commands->getSteps() as $step) {
			//echo RoverApp::getPosition($this->_position) . " ->  " . $step . ' -> ';
			$this->_position->processCommand($step);
			if (!$this->_isPositionIsValid()) {
				throw new RoverException("Way is exis from plato area. Last command is: ". $step);
			}


			//echo RoverApp::getPosition($this->_position) ."<br />";
		}
	}

	public function _isPositionIsValid() {
		$isXValid = $this->_position->getX() >= $this->_plato->getBottomCoordinate()->getX()
		&& $this->_position->getX() <= $this->_plato->getTopCoordinate()->getX();

		$isYValid =  $this->_position->getY() >= $this->_plato->getBottomCoordinate()->getY()
			&& $this->_position->getX() <= $this->_plato->getTopCoordinate()->getY();

		return $isXValid && $isYValid;
	}

} 