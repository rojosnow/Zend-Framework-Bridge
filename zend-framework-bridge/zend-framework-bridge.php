<?php
/**
 * Plugin Name: Zend Framework Bridge
 * Plugin URI: http://jordanjr.com/code/wordpress/zend-framework-bridge
 * Description: Use this plugin to integrate Zend Framework 1.11.11 (minimal) with Wordpress.
 * Version: 1.11.11
 * Author: Robert Jordan
 * Author URI: http://jordanjr.com
 * License: GNU General Public License, version 2
 * 
 * Copyright 2011  Robert Jordan  (email : robert@jordanjr.com)
 * 
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License, version 2, as 
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Zend Framework class for hook functions
 * Reference: http://www.leftjoin.net/2011/03/integrating-zend-framework-with-wordpress/
 */

Class Zend_Framework_Bridge {
    
    /**
     * Plugin activate
     */
    function zend_framework_bridge_plugin_activate()
    {
        // set plugin options
        $zend_framework_bridge_options = array(
            'plugin_version' => '1.11.11'
        );
        update_option('zend_framework_bridge_options', $zend_framework_bridge_options);
    }
    
    /**
     * Plugin deactivate
     */
    function zend_framework_bridge_plugin_deactivate()
    {
    }
    
    /**
     * init plugin
     */
    function zend_framework_bridge_plugin_init()
    {
        // set zend framework library path
        set_include_path(
            implode(PATH_SEPARATOR, array(
                get_include_path(),
                plugin_dir_path(__FILE__) . '/library'
            )));

        // require the autoloader
        require_once(plugin_dir_path(__FILE__) . '/library/Zend/Loader/Autoloader.php');

        // instance the autoloader
        Zend_Loader_Autoloader::getInstance();
    }

}

// plugin activation
register_activation_hook(__FILE__, array('Zend_Framework_Bridge', 'zend_framework_bridge_plugin_activate'));

// plugin deactivation
register_deactivation_hook(__FILE__, array('Zend_Framework_Bridge', 'zend_framework_bridge_plugin_deactivate'));

// add action
add_action('plugins_loaded', array('Zend_Framework_Bridge', 'zend_framework_bridge_plugin_init'));
