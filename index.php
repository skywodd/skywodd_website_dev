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
require __DIR__ . '/config/baseconfig.php';      // Include the base configuration file
require __DIR__ . '/vendor/PSR0ClassLoader.php'; // Include the PSR-0 compliant class loader

/* Instantiate and register the class loader */
$classLoader = new PSR0ClassLoader('\\', __DIR__ . '/vendor');
$classLoader->register();

/* Top-level dependencies */
use Skywodd\Assertion\AssertionHandler; // Assertation handling toolkit
use Skywodd\Routing\HierarchicalRouter; // HMVC router
use Skywodd\Routing\SimpleRoute;        // Simple route implementation

/* Start assertion handling */
AssertionHandler::start();

/* Get the requested URI ressource path and rebase it if necessary */
if (BASE_ISROOT)
    $ressourcePath = $_SERVER['REQUEST_URI'];
else // Ressource path need to be rebased
    $ressourcePath = HierarchicalRouter::rebaseRessourcePath($_SERVER['REQUEST_URI'], BASE_DIRECORY);

/* Instantiate a new router */
$router = new HierarchicalRouter(__DIR__ . '/controllers');

/* Set default routes */
$router->setDefaultHomeController('FrontMainController', 'home');
$router->setDefaultErrorController('FrontErrorController');

/* Add some custom routes */
$router->addRoute(new SimpleRoute('hello', 'FrontMainController')); // Test route
//TODO

/* Start the routing process */
$router->processRessourcePath($ressourcePath);

?>