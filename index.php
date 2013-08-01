<?php

/**
 * Front-end file, dispatch all incoming requests to the rigth controller.
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

/* Low-level dependencies */
require __DIR__ . '/vendor/PSR0ClassLoader.php'; // Include the PSR-0 compliant class loader

/* Instantiate and register the class loader */
$classLoader = new PSR0ClassLoader('\\', __DIR__ . '/vendor');
$classLoader->register();

/* Top-level dependencies */
use \Skywodd\Assertion\AssertionHandler; // Assertation handling toolkit

/* Start assertion handling */
AssertionHandler::start();

/* Main index code */
echo '<h1>SOON</h1>';
// TODO everything else
?>