<?php
/**
 * Created by PhpStorm.
 * User: petun
 * Date: 14.08.15
 * Time: 0:39
 */

namespace Rover\Factory;


use Rover\Exceptions\RoverFactoryException;
use Rover\Input\Coordinate;

class CoordinatesFactory {

	public static function create($str) {

		$parts = explode(" ",trim($str));
		if (count($parts) == 2) {
			return new Coordinate($parts[0], $parts[1]);
		}
		throw new RoverFactoryException("Invalid input string for creating coordinates object. Str = $str");

	}

}