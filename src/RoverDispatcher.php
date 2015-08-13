<?php


namespace Rover;

use Rover\Input;
use Rover\Input\Plato;
use Rover\Input\CommandSequence;
use Rover\Input\RoverPosition;

class RoverDispatcher {

	private $_rovers = array();

	/**
	 * @param $x
	 * @param $y
	 * @internal param Plato $platoCoordinates
	 */
	public function setPlatoCoordinates($x, $y) { // todo наподумать.. может и координатой передавать
		$this->_platoCoords = new Input\Coordinate($x, $y);
	}

	/**
	 * @param RoverPosition $position
	 * @param CommandSequence $commands
	 */
	public function addRover(RoverPosition $position, CommandSequence $commands) {
		$this->_rovers = new Rover($position, $commands);
	}

	public function start() {
		foreach ($this->_rovers as $rover) {
			/* @var Rover $rover  */
			$rover->walk();
		}
	}


}