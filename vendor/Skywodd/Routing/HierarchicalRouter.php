<?php

/**
 * Hierarchical router system
 * 
 * This class implement the router part of the HMVC (Hierarchical Model View Controler) design patern.
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

/* PSR-0 compliant namespace */
namespace Skywodd\Routing;

/* Dependencies */
use Skywodd\Routing\Route;

/**
 * Hierarchical router part of HMVC design patern
 *
 * @version 1.0
 */
class HierarchicalRouter {

    /**
     * Controller files extension
     * 
     * @var string
     */
    const CONTROLLER_EXTENSION = '.php';
    
    /**
     * The directory where all controller files are stored
     * 
     * @var string
     */
    protected $_workingDirectory = '';

    /**
     * Default home controller name
     * 
     * @var string 
     */
    protected $_defaultHomeControllerName = '';

    /**
     * Default home path node
     * 
     * @var string 
     */
    protected $_defaultHomePathNode = '';

    /**
     * Default error controller name
     * 
     * @var string 
     */
    protected $_defaultErrorControllerName = '';

    /**
     * List of registered routes
     * 
     * @var Route[]
     */
    protected $_registeredRoutes = [];

    /**
     * Instantiate a new HierarchicalRouter
     *
     * @param string $workingDirectory The directory where all controller files are stored
     */
    public function __construct($workingDirectory) {

        /* Assert argument */
        assert('isset($workingDirectory) && is_string($workingDirectory)');
        assert('is_dir($workingDirectory) && is_readable($workingDirectory)');

        /* Store the controllers directory path */
        $this->_workingDirectory = $workingDirectory;
    }

    /**
     * Set the default home controller name
     * The home controller will be called when the associated path node is requested or when no path node is specified.
     * 
     * @since 1.0
     * @param string $controllerName The new default home controller name
     * @param string $homePathNode The path node associated with the home controller
     */
    public function setDefaultHomeController($controllerName, $homePathNode = '') {

        /* Assert arguments */
        assert('isset($controllerName) && is_string($controllerName)');
        assert('isset($homePathNode) && is_string($homePathNode)');
        assert('empty($controllerName) === FALSE');

        /* Store the default home controller name and path node */
        $this->_defaultHomeControllerName = $controllerName;
        $this->_defaultHomePathNode = trim($homePathNode, '/');
    }

    /**
     * Set the default error controller name
     * The error controller will be called when an unknown path node is requested.
     * 
     * @since 1.0
     * @param string $controllerName The new default error controller name
     */
    public function setDefaultErrorController($controllerName) {

        /* Assert argument */
        assert('isset($controllerName) && is_string($controllerName)');
        assert('empty($controllerName) === FALSE');

        /* Store the default error controller name */
        $this->_defaultErrorControllerName = $controllerName;
    }

    /**
     * Add a new routing rule to the router
     * This function should be called as many times as necessary.
     * 
     * @since 1.0
     * @param Route $r The route to add into the router rules
     */
    public function addRoute(Route $r) {

        /* Assert argument */
        assert('isset($r)');

        /* Append the given route to the routes array */
        $this->_registeredRoutes[] = $r;
    }

    /**
     * Run the router on the specified resource path
     * Do not forget to use the rebaseResourcePath() function before if you are not working in the web-root directory.
     * 
     * @since 1.0
     * @param string $resourcePath The input resource path to process, should be rebased if necessary
     */
    public function processResourcePath($resourcePath) {

        /* Assert argument */
        assert('isset($resourcePath) && is_string($resourcePath)');
        assert('empty($this->_defaultHomeControllerName) === FALSE');
        assert('empty($this->_defaultErrorControllerName) === FALSE');

        /* Trim slash at beginning of resource path */
        $resourcePath = trim($resourcePath, '/');

        /* Get the first path node and remaining path string */
        $pathNodes = explode('/', $resourcePath, 2);
        $pathNode = $pathNodes[0];
        $remainingPath = (count($pathNodes) == 2) ? $pathNodes[1] : '';

        /* Check for default home controller */
        if ($pathNode == '' || $pathNode == $this->_defaultHomePathNode) {

            /* Call the default home controller */
            $this->callController($this->_defaultHomeControllerName, $remainingPath);
            return;
        }

        /* Try to match any of the registered routes */
        foreach ($this->_registeredRoutes as $r) {

            /* If current route match */
            if ($r->match($pathNode)) {

                /* Call the associated controller */
                $this->callController($r->getControllerName(), $remainingPath);
                return;
            }
        }

        /* No match found, call the default error controller */
        $this->callController($this->_defaultErrorControllerName, '');
    }

    /**
     * Internal routine : instantiate and execute the specified controller
     * 
     * @since 1.0
     * @param string $controllerName The controller name (can be in a sub-directory) without the .php extension
     * @param string $controllerArgs The arguments to pass to the controller during the instantiation
     */
    protected function callController($controllerName, $controllerArgs) {

        /* Assert arguments */
        assert('isset($controllerName) && is_string($controllerName)');
        assert('isset($controllerArgs) && is_string($controllerArgs)');

        /* Compute controller filename */
        $controllerFilename = $this->_workingDirectory . DIRECTORY_SEPARATOR . $controllerName . self::CONTROLLER_EXTENSION;

        /* Assert controller file */
        assert('is_file($controllerFilename) && is_readable($controllerFilename)');

        /* Include the controller file */
        require $controllerFilename;

        /* Compute controller class name */
        $controllerClassName = basename($controllerFilename, self::CONTROLLER_EXTENSION);

        /* Assert controler class */
        assert('class_exists($controllerClassName, false)');
        
        /* Instanciate controller */
        $controller = new $controllerClassName($controllerArgs);

        /* Execute the controller */
        $controller->execute();
    }

    /**
     * Rebase (chroot like) a resource path
     * Turn absolute resource paths like "/foo/bar" into "/bar" according base path (here "/foo").
     * 
     * @since 1.0
     * @throws Exception (if unable to rebase the specified resource path)
     * @param string $resourcePath The absolute resource path
     * @param string $basePath The base path to remove from the absolute resource path
     * @return string The rebased resource path
     */
    public static function rebaseResourcePath($resourcePath, $basePath) {

        /* Assert arguments */
        assert('isset($resourcePath) && is_string($resourcePath)');
        assert('isset($basePath) && is_string($basePath)');
        assert('strlen($basePath) <= strlen($resourcePath)');

        /* Check the base path */
        if (substr($resourcePath, 0, strlen($basePath)) !== $basePath)
            throw new Exception("Cannot rebase '$resourcePath' using '$basePath' as base !");

        /* Return the rebased resource path */
        return substr($resourcePath, strlen($basePath));
    }

}

?>
