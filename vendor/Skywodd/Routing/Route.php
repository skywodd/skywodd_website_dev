<?php

/**
 * Route base class for hierarchical router
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
 * Base class for all route implementations
 * 
 * @version 1.0
 */
abstract class Route {

    /**
     * The controller name associated with the route
     * 
     * @var string
     */
    protected $_controllerName = '';

    /**
     * Match the specified path node against the implemented route matching algorithm
     * 
     * @since 1.0
     * @param string $pathNode Path node to process
     * @return bool TRUE if the path node match, FALSE otherwise
     */
    abstract public function match($pathNode);

    /**
     * Return the controller name associed with the route
     * 
     * @since 1.0
     * @return string The controller name associated with the route
     */
    public function getControllerName() {

        /* Return the associated controller name  */
        return $this->_controllerName;
    }

}

?>
