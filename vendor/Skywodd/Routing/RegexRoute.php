<?php

/**
 * Regex based route implementation
 * 
 * @author Fabien Batteix <skywodd@gmail.com>
 * @copyright Fabien Batteix 2013
 * @link http://skywodd.net
 * @package skywebsite
 */
/*
 * This file is part of Skywodd website.
 * 
 * Skywodd website is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Skywodd website is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Skywodd website. If not, see <http://www.gnu.org/licenses/>.
 */

/* PSR-0 compliant namespace */
namespace Skywodd\Routing;

/**
 * Route matcher implementation based on a regex => fixed controller name logic
 * 
 * @version 1.0
 */
class RegexRoute extends Route {

    /**
     * The path node regex who match with this route
     * 
     * @var string
     */
    protected $_pathNodeRegex = '';

    /**
     * Mapping array for back references (\N -> $_GET[X])
     * 
     * @var array
     */
    protected $_backReferenceMapping = null;

    /**
     * Instantiate a new RegexRoute
     * 
     * @param string $pathNodeRegex The path node regex who match with this route
     * @param string $controllerName The associated controller name
     * @param array $backReferenceMapping Regex back references mapping rules (\N => varname in $_GET)
     */
    public function __construct($pathNodeRegex, $controllerName, $backReferenceMapping = null) {

        /* Assert argument */
        assert('isset($pathNodeRegex) && is_string($pathNodeRegex)');
        assert('isset($controllerName) && is_string($controllerName)');
        assert('is_null($backReferenceMapping) || is_array($backReferenceMapping)');

        /* Store the excepted path node and associated controller filename */
        $this->_pathNodeRegex = $pathNodeRegex;
        $this->_controllerName = $controllerName;
        $this->_backReferenceMapping = $backReferenceMapping;
    }

    public function match($pathNode) {

        /* Assert argument */
        assert('isset($pathNode) && is_string($pathNode)');
        assert('strrpos($pathNode, \'/\') === FALSE');

        /* Temp variable */
        $matches = null;

        /* Check if the path node and regex match */
        // WARNING: DO NOT FUCKING USE FUCKING REGEX WITH FUCKING MODE "e" (eval)
        $res = (bool) preg_match($this->_pathNodeRegex, $pathNode, $matches);

        /* Map matches if required */
        if (!is_null($this->_backReferenceMapping)) {
            
            /* Map all matches */
            foreach ($matches as $key => $value) {
                
                /* Skip matches 0 (full match string) if not needed */
                if($key === 0 && !isset($this->_backReferenceMapping[0]))
                    continue;
                
                /* Set the GET variable */
                assert('isset($this->_backReferenceMapping[$key])');
                $_GET[$this->_backReferenceMapping[$key]] = $value;
            }
        }

        /* Return the result */
        return $res;
    }

}

?>
