<?php

/**
 * Front error controller class.
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

/* Dependencies */
use Skywodd\Routing\Controller; // Controller common interface

/**
 * Front error controller class
 * 
 * @version 1.0
 */
class FrontErrorController implements Controller {
    
    public function __construct($remainingPath) {
        
    }

    public function execute() {
        
        /* Test code */
        echo '<h1>ERROR</h1>';
    } 
    
}

?>
