<?php

namespace Rover;

use Rover\Exceptions\RoverException;
use Rover\Factory\CoordinatesFactory;
use Rover\Factory\RoverPositionFactory;
use Rover\Input\CommandSequence;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;

class RoverApp
{
	private $_input = array();

	/* @var RoverDispatcher */
	private $_dispatcher;

	private $_roverPositions = array();

	private $_commandSequences = array();

	private $_errors = array();

	public static function getPosition(RoverPosition $position) { //todo delete of make private not static
		return sprintf('%d %d %s', $position->getCoordinates()->getX(), $position->getCoordinates()->getY(), $position->getDirection());
	}

	public function __construct($input) {
		$this->_dispatcher  = new RoverDispatcher();

		if (!is_string($input)) {
			throw new RoverException('Input must be a string');
		}

		$this->_input = explode("\n", $input);

		if (count($this->_input) < 3) {
			throw new RoverException("Error in input string. See input format for details.");
		}

		$configsHasEmptyLines = count(array_filter($this->_input, function($val) { $val = trim($val); return empty($val);})) > 0;
		if ($configsHasEmptyLines) {
			throw new RoverException('Find empty lines in config. See input format for details.');
		}
	}

	public function processBatchCommand() {
		$this->_normalizeInput();
		$this->_createInputObjects();
		$this->_runDispatcher();
		return $this->_getResultData();
	}

	private function _normalizeInput() {
		$this->_input = array_map(
			function ($input) {
				return trim($input);
			}, $this->_input
		);
	}

	private function _createInputObjects() {
		$platoStr = array_shift($this->_input);

		$platoTopCoordinates = CoordinatesFactory::create($platoStr);
		$this->_dispatcher->setPlato(new Plato($platoTopCoordinates));

		$isEvenLines = count($this->_input) % 2 == 0;

		if (!$isEvenLines) {
			throw new RoverException("Invalid configuration for rovers. Missing command or coordinates line");
		}

		for ($i = 0; $i < count($this->_input); $i++) {
			if ($i % 2) {
				$this->_commandSequences[] = new CommandSequence($this->_input[$i]);
			} else {
				$this->_roverPositions[] = RoverPositionFactory::create($this->_input[$i]);
			}
		}
	}

	private function _runDispatcher() {
		foreach ($this->_commandSequences as $index => $commandSequence) {
			$this->_dispatcher->addRover($this->_roverPositions[$index], $commandSequence);
		}

		$this->_dispatcher->start();
	}

	private function _getResultData() {
		$result = array();
		foreach ($this->_dispatcher->getRovers() as $rover) {
			/* @var $rover Rover */
			$result[] = self::getPosition($rover->getPosition());
		}

		return implode("\n", $result);
	}

}