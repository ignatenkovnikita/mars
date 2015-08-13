<?php


namespace Rover;

use Rover\Input;
use Rover\Input\Plato;
use Rover\Input\CommandSequence;
use Rover\Input\RoverPosition;

class RoverDispatcher {

	private $_rovers = array();

	private $_plato;


	/**
	 * @param Plato $plato
	 */
	public function setPlato(Plato $plato) {
		$this->_plato = $plato;
	}

	/**
	 * @param RoverPosition $position
	 * @param CommandSequence $commands
	 */
	public function addRover(RoverPosition $position, CommandSequence $commands) {
		$this->_rovers[] = new Rover($position, $commands, $this->_plato);
	}

	public function start() {
		foreach ($this->_rovers as $rover) {
			/* @var Rover $rover  */
			$rover->walk();
		}
	}

	public function getRovers() {
		return $this->_rovers;
	}


}