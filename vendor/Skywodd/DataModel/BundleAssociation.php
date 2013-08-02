<?php

/**
 * Publication bundle association data model
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
namespace Skywodd\BaseAPI;

/**
 * Publication bundle association data model
 * 
 * @version 1.0
 */
class BundleAssociation {

    /**
     * Bundle ID
     *
     * @var integer
     */
    protected $_bundleId = 0;

    /**
     * Publication ID
     *
     * @var integer
     */
    protected $_publicationId = 0;

    /**
     * Page number
     *
     * @var integer
     */
    protected $_pageNumber = 0;

    /**
     * Instantiate a new BundleAssocation object
     * 
     * @param integer $bundleId The bundle ID of this association
     */
    public function __construct($bundleId) {

        /* Assert argument */
        assert('isset($bundleId) && is_int($bundleId)');
        assert('$bundleId >= 0');

        /* Store bundle ID value */
        $this->_bundleId = $bundleId;
    }

    /**
     * Get the bundle ID
     * 
     * @return integer
     */
    public function getBundleId() {
        return $this->_bundleId;
    }

    /**
     * Get the publication ID
     * 
     * @return integer
     */
    public function getPublicationId() {
        return $this->_publicationId;
    }

    /**
     * Set the publication ID
     * 
     * @param integer $publicationId The new publication ID
     */
    public function setPublicationId($publicationId) {
        
        /* Assert argument */
        assert('isset($publicationId) && is_int($publicationId)');
        assert('$publicationId >= 0');

        /* Store publication ID value */
        $this->_publicationId = $publicationId;
    }

    /**
     * Get the page number
     * 
     * @return integer
     */
    public function getPageNumber() {
        return $this->_pageNumber;
    }
    
    /**
     * Set the page number
     * 
     * @param integer $pageNumber The new page number
     */
    public function setPageNumber($pageNumber) {
        
        /* Assert argument */
        assert('isset($pageNumber) && is_int($pageNumber)');
        assert('$pageNumber >= 0');

        /* Store page number value */
        $this->_pageNumber = $pageNumber;
    }
    
}

?>