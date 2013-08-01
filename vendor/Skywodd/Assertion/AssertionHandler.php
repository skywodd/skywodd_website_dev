<?php

/**
 * Assertion handling toolkit
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
namespace Skywodd\Assertion;

/**
 * Assertion handling management class
 * 
 * @version 1.0
 */
class AssertionHandler {

    /**
     * Assertion handling routine
     * 
     * @since 1.0
     * @param string $file File where the assertion has failed
     * @param string $line Line in file where the assertion has failed
     * @param string $code Code who has triggered the assertion
     * @param string $desc Description of the assertion (if any)
     */
    public static function handle($file, $line, $code, $desc = null) {

        /* Print debug message */
        if (is_null($desc))
            $desc = 'no description';
        echo "<h1>ASSERTION FAILED in file: '$file' at line: '$line' with code: '$code' ($desc)</h1>";
    }

    /**
     * Enable asssertion handling
     * 
     * @since 1.0
     */
    public static function start() {

        /* Setup assertion handling */
        assert_options(ASSERT_ACTIVE, 1);     // Assertion enabled
        assert_options(ASSERT_WARNING, 0);    // Disable PHP warning
        assert_options(ASSERT_QUIET_EVAL, 1); // Enable quiet eval
        assert_options(ASSERT_BAIL, 1);       // Stop execution on failed asertion

        /* Register assertion handler */
        assert_options(ASSERT_CALLBACK, 'AssertionHandler::handle');
    }

    /**
     * Disable assertion handling
     * 
     * @since 1.0
     */
    public static function stop() {
        assert_options(ASSERT_ACTIVE, 0); // Assertion disabled
    }

}

?>
