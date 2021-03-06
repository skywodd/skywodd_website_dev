<?php

/**
 * Front-end file, dispatch all incoming requests.
 * 
 * This file is the front-end of the website, all incoming requests MUST go to this file (thanks to url rewriting).
 * This file internaly dispatch incoming requests according to their URI and execute the controller code associated with this URI.
 * 
 * @author Fabien Batteix <skywodd@gmail.com>
 * @copyright Fabien Batteix 2013
 * @link http://skywodd.net My website
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3
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
require __DIR__ . '/config/baseconfig.php';      // Include the base configuration file
require __DIR__ . '/vendor/PSR0ClassLoader.php'; // Include the PSR-0 compliant class loader

/* Instantiate and register the class loader to load classes at runtime */
$classLoader = new PSR0ClassLoader('\\', __DIR__ . '/vendor');
$classLoader->register();

/* Top-level dependencies */
use Skywodd\Assertion\AssertionHandler; // Assertation handling toolkit
use Skywodd\Routing\HierarchicalRouter; // HMVC router
use Skywodd\Routing\SimpleRoute;        // Simple route implementation
use Skywodd\Routing\FileRoute;          // File based route implementation
//use Skywodd\Routing\RegexRoute;         // Regex based route implementation

/* Start assertions handling */
AssertionHandler::start();

/* Get the requested URI resource path and rebase it if necessary */
if (BASE_IS_ROOT)
    $resourcePath = $_SERVER['REQUEST_URI'];
else // Resource path need to be rebased before use
    $resourcePath = HierarchicalRouter::rebaseResourcePath($_SERVER['REQUEST_URI'], BASE_DIRECORY);

/* Instantiate a new hierarchical router */
$router = new HierarchicalRouter(__DIR__ . '/controllers');

/* Set default routes */
$router->setDefaultHomeController('HomeController', '');
$router->setDefaultErrorController('ErrorController');

/* Add some custom routes */
$router->addRoute(new SimpleRoute('skyduino', 'SkyduinoController'));              // /skyduino route
$router->addRoute(new FileRoute(__DIR__ . '/controllers', 'Front', 'Controller')); // Front controllers routes
//$router->addRoute(new RegexRoute('/^test-([0-9]+)-(.*)$/', 'FrontTestController', [1 => 'id', 2 => 'permalink']));

/* Start the routing process */
$router->processResourcePath($resourcePath);

?>