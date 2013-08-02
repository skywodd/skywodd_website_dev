<?php

/**
 * Category data model
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
 * Category data model
 * 
 * @version 1.0
 */
class Category {

    /**
     * Category ID
     *
     * @var integer
     */
    protected $_id = 0;

    /**
     * Category title
     *
     * @var string
     */
    protected $_title = '';

    /**
     * Category brief
     *
     * @var string
     */
    protected $_brief = '';

    /**
     * Parent category ID
     *
     * @var integer
     */
    protected $_parentId = 0;

    /**
     * Child count
     *
     * @var integer
     */
    protected $_childCount = 0;

    /**
     * Instantiate a new Cateogory object
     * 
     * @param integer $categoryId Category ID (if already known)
     */
    public function __construct($categoryId = null) {

        /* Assert argument */
        assert('is_null($categoryId) || (isset($categoryId) && is_int($categoryId) && ($categoryId >= 0))');

        /* Store category ID value */
        $this->_id = $categoryId;
    }

    /**
     * Get the category ID
     * 
     * @return integer
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Get the category title
     * 
     * @return string
     */
    public function getTitle() {
        return $this->_title;
    }

    /**
     * Set the category title
     * 
     * @param string $title The new category title
     */
    public function setTitle($title) {
        
        /* Assert argument */
        assert('isset($title) && is_string($title)');

        /* Store category title value */
        $this->_title = $title;
    }

    /**
     * Get the category brief
     * 
     * @return string|null
     */
    public function getBrief() {
        return $this->_brief;
    }

    /**
     * Set the category brief
     * 
     * @param string|null $brief The new category brief
     */
    public function setBrief($brief) {
        
        /* Assert argument */
        assert('is_null($brief) || is_string($brief)');

        /* Store category brief value */
        $this->_brief = $brief;
    }

    /**
     * Get the parent ID
     * 
     * @return integer|null
     */
    public function getParentId() {
        return $this->_parentId;
    }

    /**
     * Set the parent ID
     * 
     * @param integer|null $parentId The new parent ID
     */
    public function setParentId($parentId) {
        
        /* Assert argument */
        assert('is_null($parentId) || (isset($parentId) && is_int($parentId) && ($parentId >= 0))');
        
        /* Store parent ID value */
        $this->_parentId = $parentId;
    }

    /**
     * Get the child count
     * 
     * @return integer
     */
    public function getChildCount() {
        return $this->_childCount;
    }

    /**
     * Set the child count
     * 
     * @param integer $childCount The new child count
     */
    public function setChildCount($childCount) {
        
        /* Assert argument */
        assert('isset($childCount) && is_int($childCount) && ($childCount >= 0)');
        
        /* Store child count value */
        $this->_childCount = $childCount;
    }
    
    /**
     * Increment the number of child count
     * 
     * @param integer $number Once the number of child count will be incremented
     */
    public function incrementChidCount($number = 1) {
        
        /* Assert argument */
        assert('isset($number) && is_int($number) && ($number > 0)');
        
        /* Compute the new child count value */
        $this->_childCount += $number;
        assert('$childCount >= 0');
    }
    
    /**
     * Decrement the number of child count
     * 
     * @param integer $number Once the number of child count will be decremented
     */
    public function decrementChidCount($number = 1) {
        
        /* Assert argument */
        assert('isset($number) && is_int($number) && ($number > 0)');
        
        /* Compute the new child count value */
        $this->_childCount -= $number;
        assert('$childCount >= 0');
    }
    
}

?>