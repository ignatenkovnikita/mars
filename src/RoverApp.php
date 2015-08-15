<?php

namespace Rover;

use Rover\Exceptions\RoverException;
use Rover\Factory\CoordinatesFactory;
use Rover\Factory\RoverPositionFactory;
use Rover\Input\CommandSequence;
use Rover\Input\Plato;
use Rover\Input\RoverPosition;


/**
 * Class RoverApp
 *
 * Top layout of the application. Get input - generated output
 *
 * @package Rover
 */
class RoverApp
{
	private $_inputStr;

	private $_inputLines = array();

	/* @var RoverDispatcher */
	private $_dispatcher;

	private $_roverPositions = array();

	private $_commandSequences = array();

	public function __construct($input) {
		$this->_dispatcher  = new RoverDispatcher();

		$this->_inputStr = $input;

		if (!is_string($this->_inputStr)) {
			throw new RoverException("Input must be a string.");
		}

		$this->_generateInputLines();

		$this->_checkInputFormat($input);
	}

	private function _generateInputLines() {
		$this->_inputLines = explode("\n", trim($this->_inputStr));
		$this->_inputLines = array_map('trim', $this->_inputLines);
	}

	public function _checkInputFormat() {
		if (count($this->_inputLines) < 3) {
			throw new RoverException("Error in input string. See input format for details.");
		}

		$configsHasEmptyLines = count(array_filter($this->_inputLines, function($val) { $val = trim($val); return empty($val);})) > 0;
		if ($configsHasEmptyLines) {
			throw new RoverException('Find empty lines in config. See input format for details.');
		}

		$isEvenLines = count($this->_inputLines) % 2 == 0;
		if ($isEvenLines) {
			throw new RoverException("Invalid configuration for rovers. Missing command or coordinates line");
		}
	}



	public function processBatchCommand() {
		$this->_createInputObjects();
		$this->_runDispatcher();
		return $this->_getResultData();
	}


	private function _createInputObjects() {
		$platoStr = array_shift($this->_inputLines);

		$platoTopCoordinates = CoordinatesFactory::create($platoStr);
		$this->_dispatcher->setPlato(new Plato($platoTopCoordinates));

		for ($i = 0; $i < count($this->_inputLines); $i++) {
			if ($i % 2) {
				$this->_commandSequences[] = new CommandSequence($this->_inputLines[$i]);
			} else {
				$this->_roverPositions[] = RoverPositionFactory::create($this->_inputLines[$i]);
			}
		}

		foreach ($this->_commandSequences as $index => $commandSequence) {
			$this->_dispatcher->addRover($this->_roverPositions[$index], $commandSequence);
		}
	}

	private function _runDispatcher() {
		$this->_dispatcher->start();
	}

	private function _getResultData() {
		$result = array();
		foreach ($this->_dispatcher->getRovers() as $rover) {
			/* @var $rover Rover */
			$result[] = $this->_formatPosition($rover->getPosition());
		}

		return implode("\n", $result);
	}

	private function _formatPosition(RoverPosition $position) {
		return sprintf('%d %d %s', $position->getCoordinates()->getX(), $position->getCoordinates()->getY(), $position->getDirection());
	}

}