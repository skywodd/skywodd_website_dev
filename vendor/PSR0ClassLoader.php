<?php

/**
 * PSR-0 compliant class loader.
 * 
 * @see http://groups.google.com/group/php-standards/web/final-proposal
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

/**
 * Simple yet powerfull implementation of PSR-0 namespace and class loading standard.
 * 
 * @version 1.0
 */
class PSR0ClassLoader {
    
    /**
     * Separator between two namespaces.
     * 
     * @var string
     */
    const NAMESPACE_SEPARATOR = '\\';

    /**
     * Class files extension.
     * 
     * @var string
     */
    const FILE_EXTENSION = '.php';

    /**
     * Root namespace (aka "vendor" namespace).
     * 
     * @var string 
     */
    protected $_rootNamespace = '';

    /**
     * Include path associated with the root namespace.
     * 
     * @var string 
     */
    protected $_includePath = '';

    /**
     * Instantiate a new class loader that loads classes of the specified namespace.
     * 
     * @param string $rootNamespace The root namespace managed by this loader.
     * @param string $includePath The associated include path for this loader.
     */
    public function __construct($rootNamespace, $includePath) {

        /* Store root namespace and include path */
        $this->_rootNamespace = $rootNamespace;
        $this->_includePath = $includePath;
    }

    /**
     * Register this class loader on the SPL autoload stack.
     * 
     * @since 1.0
     */
    public function register() {
        spl_autoload_register(array($this, 'loadClass')); // Register the class loading routine
    }

    /**
     * Unregister this class loader from the SPL autoloader stack.
     * 
     * @since 1.0
     */
    public function unregister() {
        spl_autoload_unregister(array($this, 'loadClass')); // Unregister the class loading routine
    }

    /**
     * Load the given class or interface.
     *
     * @since 1.0
     * @param string $className The name of the class to load.
     */
    public function loadClass($className) {

        /* Check if this loader handle all namespaces (\\) or if the given namespace match with this loader */
        if ($this->_rootNamespace !== self::NAMESPACE_SEPARATOR)
            if (substr($className, 0, strlen($this->_namespace . self::NAMESPACE_SEPARATOR)) !== $this->_rootNamespace . self::NAMESPACE_SEPARATOR)
                return;

        /* Get the last occurence of NAMESPACE_SEPARATOR */
        $lastNamespaceSepPos = strripos($className, self::NAMESPACE_SEPARATOR);

        /* Check if the class name is correct (namespace + \\ + class name) */
        if ($lastNamespaceSepPos === false)
            throw new Exception('Malformed class name : ' . $className);

        /* Compute namespace and class name */
        $namespace = substr($className, 0, $lastNamespaceSepPos);
        $className = substr($className, $lastNamespaceSepPos + 1);

        /* According to PSR-0 standard file name is the class name with underscore and namespace separators turned into directory separator */
        $fileName = str_replace(self::NAMESPACE_SEPARATOR, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . self::FILE_EXTENSION;

        /* Last step : load the file ! */
        require $this->_includePath . DIRECTORY_SEPARATOR . $fileName;
    }

}