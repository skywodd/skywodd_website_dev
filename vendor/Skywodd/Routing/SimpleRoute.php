<?php

/**
 * Simple route implementation
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
 * Route matcher implementation based on a fixed path node => controller name logic
 * 
 * @version 1.0
 */
class SimpleRoute extends Route {

    /**
     * The path node who match with this route
     * 
     * @var string
     */
    protected $_pathNode = '';

    /**
     * Instantiate a new SimpleRoute
     * 
     * @param string $pathNode The path node who match with this route
     * @param string $controllerName The associated controller name 
     */
    public function __construct($pathNode, $controllerName) {

        /* Assert arguments */
        assert('isset($pathNode) && is_string($pathNode)');
        assert('isset($controllerName) && is_string($controllerName)');

        /* Store the path node and his associated controller name */
        $this->_pathNode = trim($pathNode, '/');
        $this->_controllerName = $controllerName;
    }

    public function match($pathNode) {

        /* Assert argument */
        assert('isset($pathNode) && is_string($pathNode)');
        assert('strrpos($pathNode, \'/\') === FALSE');

        /* Check if the path node and route match */
        return $this->_pathNode == $pathNode;
    }

}

?>
