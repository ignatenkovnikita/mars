<?php

namespace Rover;

use Rover\Input\CommandSequence;
use Rover\Input\RoverPosition;

class Rover {

	/* @var RoverPosition */
	protected $_position;

	protected $_commands;

	public function __construct(RoverPosition $position, CommandSequence $commands) {
		$this->_position = $position;
		$this->_commands = $commands;
	}

	public function getPosition() {
		return $this->_position;
	}

	public function walk() {
		foreach ($this->_commands->getSteps() as $step) {
			echo RoverApp::getPosition($this->_position) . " ->  " . $step . ' -> ';
			$this->_position->processCommand($step);
			echo RoverApp::getPosition($this->_position) ."<br />";
		}
	}

} 