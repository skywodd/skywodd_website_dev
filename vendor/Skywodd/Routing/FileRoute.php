<?php

/**
 * File based route implementation
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
 * Route matcher implementation based on available controller files
 * 
 * @version 1.0
 */
class FileRoute extends Route {

    /**
     * Controller class files extension.
     * 
     * @var string
     */
    const PHP_FILE_EXTENSION = '.php';
    
    /**
     * The directory where all controller files are stored
     * 
     * @var string
     */
    protected $_workingDirectory = '';
    
    /**
     * Controller filename prefix
     * 
     * @var string
     */
    protected $_filenamePrefix = '';
    
    /**
     * Controller filename suffix
     * 
     * @var string
     */
    protected $_filenameSuffix = '';

    /**
     * Instantiate a new FileRoute
     * 
     * @param string $controllersDirectory The directory where all controller files are stored
     * @param string $filenamePrefix The prefix to be added before the controller name
     * @param string $filenameSuffix The suffix to be added after the controller name
     */
    public function __construct($controllersDirectory, $filenamePrefix = '', $filenameSuffix = 'Controller') {

        /* Assert argument */
        assert('isset($controllersDirectory) && is_string($controllersDirectory)');
        assert('is_dir($controllersDirectory) && is_readable($controllersDirectory)');
        assert('isset($filenamePrefix) && is_string($filenamePrefix)');
        assert('isset($filenameSuffix) && is_string($filenameSuffix)');

        /* Store the controllers directory path and filename derivation callback */
        $this->_workingDirectory = $controllersDirectory;
        $this->_filenamePrefix = $filenamePrefix;
        $this->_filenameSuffix = $filenameSuffix;
    }

    public function match($pathNode) {

        /* Assert argument */
        assert('isset($pathNode) && is_string($pathNode)');
        assert('strrpos($pathNode, \'/\') === FALSE');
        
        /* Clean up input */
        $pathNode = preg_replace('/[^a-z0-9\\-\\_]/i', '', $pathNode);
        
        /* Only lowercase path are matched to avoid duplicate-content */
        if (ctype_lower($pathNode) === False)
            return False;

        /* Turn the path node into a controller class name */
        $this->_controllerName = $this->_filenamePrefix . ucfirst($pathNode) . $this->_filenameSuffix;

        /* Check if the controller file exist */
        return file_exists($this->_workingDirectory . DIRECTORY_SEPARATOR . $this->_controllerName . self::PHP_FILE_EXTENSION);
    }

}

?>
