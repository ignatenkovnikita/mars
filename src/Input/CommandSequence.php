<?php

namespace Rover\Input;


use Rover\Exceptions\InvalidCommandSequenceException;

/**
 * Class CommandSequence
 * Represents command sequence. eg LLMMLLL
 * @package Rover\Input
 */
class CommandSequence {

	const TURN_LEFT = 'L';
	const TURN_RIGHT = 'R';
	const MOVE_FORWARD = 'M';


	private $_steps = array();

	public function __construct($steps) {
		if ($this->_isValid($steps)) {
			foreach (str_split($steps) as $step) {
				$this->_steps[] = strtoupper($step);
			}
		} else {
			throw new InvalidCommandSequenceException("Not valid command sequence. - ". $steps);
		}
	}

	/**
	 * Return one single command
	 * @return array
	 */
	public function getSteps() {
		return $this->_steps;
	}


	private function _isValid($steps) {
		return  is_string($steps) && strlen($steps) > 0 &&  preg_match('/^[LRM]+$/', $steps);
	}
}