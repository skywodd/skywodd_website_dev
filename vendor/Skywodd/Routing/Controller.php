<?php

/**
 * Common interface for any controller class
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
 * Common interface for controller classes
 * 
 * @version 1.0
 */
interface Controller {

    /**
     * Common controller constructor
     * 
     * @param string $remainingPath Unprocessed part of the ressource path from the hierarchical routing process
     */
    public function __construct($remainingPath);

    /**
     * Execute the controller
     * 
     * @since 1.0
     */
    public function execute();
}

?>
