<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 14.08.15
 * Time: 0:43
 */

namespace Rover\Factory;


use Rover\Exceptions\RoverFactoryException;
use Rover\Input\Coordinate;
use Rover\Input\RoverPosition;

class RoverPositionFactory {

	public static function create($str) {
		$parts = explode(" ",trim($str));
		if (count($parts) == 3) {
			return new RoverPosition(new Coordinate($parts[0], $parts[1]), $parts[2]);
		}
		throw new RoverFactoryException("Invalid input string for creating coordinates object. Str = $str");
	}

}