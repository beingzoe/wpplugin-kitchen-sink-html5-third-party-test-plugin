<?php
/**
Plugin Name:    Kitchen Sink HTML5 Plugin Pack
Plugin URI:     http://beingzoe.com/zui/wordpress/kitchen_sink_theme
Description:    This just does nothing.
Version:        0.1
Author:         zoe somebody
Author URI:     http://beingzoe.com/
License:        MIT
 *
 * @author		zoe somebody
 * @link        http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @copyright	Copyright (c) 2011, zoe somebody, http://beingzoe.com
 * @license		http://en.wikipedia.org/wiki/MIT_License The MIT License
 * @package     WordPress 
 * @subpackage  KitchenSinkPlugin
 */

/**
 * This is a KST dependent plugin for WordPress
 * Check first to see that the KST plugin (Kitchen Sink HTML5 Base) is loaded
 * If not then go ahead and activate and display a HELPFUL message to download 
 * KST everytime they go to the Plugins Page in the WP admin
 */

$my_settings = array(
            /* REQUIRED */
            'theme_name'                => 'Kitchen Sink HTML5 Plugin Pack',                 // Required; friendly name used by all widgets, libraries, and classes; can be different than the registered theme name
            'prefix'                 => 'kst_plugin_pack_',                       // Required; Prefix for namespacing libraries, classes, widgets
            'theme_developer'           => 'zoe somebody',                           // Required; friendly name of current developer; only used for admin display;
            'theme_developer_url'       => 'http://beingzoe.com/',            // Required; full URI to developer website;
        );
 
switch ( class_exists('KST_KST') ) {
    // Your KST Dependent plugin code goes here
    case TRUE:
        add_action('plugins_loaded', 'tell_me_something');
        /**
         * Companion plugin init
         * Define contstants used throughout KST
         *
         */
         global $kst;
        /**
         * Various Kitchen Sink HTML5 Base settings
         */
        
            
         /* Invoke the plugin to use it */
        $kst->init($my_settings);
        
        function tell_me_something() {
            global $kst;
            //echo $kst->{test_companion_0_1}->testme;
        }
    break;
    // Your
    default;
        add_action('admin_notices', 'make_sure'); // Insert notice hook
        function make_sure() { // Outputs some help info and a download link
            if ( substr( $_SERVER["PHP_SELF"], -11 ) == 'plugins.php' && !class_exists('KST_KST') ) {
                echo "<div class='updated'><p>The <strong>{$GLOBALS['my_settings']['theme_name']}</strong> plugin requires the KST base plugin.<br /><a href='#'>Download and install KST Base</a></p></div>";
            //exit('FAILURE');
            }
        }
    break;
}

