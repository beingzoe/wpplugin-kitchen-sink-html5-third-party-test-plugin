<?php
/**
Plugin Name:    Kitchen Sink HTML5 Third Party Dev Test Plugin
Plugin URI:     http://beingzoe.com/zui/wordpress/kitchen_sink/
Description:    This just does nothing.
Version:        0.1
Author:         zoe somebody
Author URI:     http://beingzoe.com/
License:        MIT
 *
 * This is a Kitchen Sink HTML5 Base (KST) dependent plugin for WordPress
 *
 * This plugin doesn't DO anything really other than exist with one of each
 * appliance typically (though could change depending on what we are testing).
 *
 * This in conjunction with a demo theme is running at all times during
 * KST development to ensure backwards compatibility and
 * we do not break existing theme/plugins.
 *
 * @author		zoe somebody
 * @link        http://beingzoe.com/zui/wordpress/kitchen_sink_theme
 * @copyright	Copyright (c) 2011, zoe somebody, http://beingzoe.com
 * @license		http://en.wikipedia.org/wiki/MIT_License The MIT License
 * @package     WordPress
 * @subpackage  KitchenSinkPlugin
*/

// Set the settings for the plugin outside of our 'exists' check so we can use it regardless
$kst_plugin_dev_test_settings = array(
        /* REQUIRED */
        'friendly_name'       => 'KST Sample Plugin',
        'prefix'              => 'kst_plugin_dev_test',
        'developer'           => 'zoe somebody',
        'developer_url'       => 'http://beingzoe.com/',
    );

// NEED TO PROTECT YOUR THEME FROM KST BEING UNINSTALLED
if ( class_exists('KST') ) {

        // Register your plugin with KST
        // Then init the features you want to use individually
        $kst_plugin_dev_test_plugin = new KST_Kitchen_Plugin($kst_plugin_dev_test_settings, 'and_the_kitchen_sink');

        // Add Options
        $kst_plugin_dev_test_options =  array(
            'parent_slug'           => 'kst',
            'menu_title'            => 'Test Plugin Settings',
            'page_title'            => 'Test Plugin Settings',
            'capability'            => 'manage_options',
            'view_page_callback'    => "auto",
            'options'               => array(
                    array(  "name"    => __('PLUGIN Some notes'),
                            "desc"  => __("
                                        <p><em>Just wanted to say hi and let you know in this demo this array appears as two different menu items.</em></p>
                                        "),
                            "type"  => "section",
                            "is_shut"   => FALSE ),

                    array(  "name"  => __('PLUGIN Favorite color'),
                            "desc"  => __('Red? Green? Blue?'),
                            "id"    => "favorite_color",
                            "default"   => "",
                            "type"  => "text",
                            "size"  => "15"),

                    array(  "name"    => __('PLUGIN TEST2'),
                            "desc"  => __("

                                        "),
                            "type"  => "section"),

                    array(  "name"  => __('PLUGIN TEST RADIO BUTTON'),
                            "desc"  => __('What choice will you make?'),
                            "id"    => "TEST_RADIO_BUTTON",
                            "default"   => "this radio 3",
                            "type"  => "radio",
                            "options" => array(     "this radio 1",
                                                    "this radio 2",
                                                    "this radio 3",
                                                    "this radio 4",
                                                    "this radio 5"
                                                        )
                            ),

                        array(    "name"    => __('PLUGIN Textarea'),
                                        "desc"    => __("What you type here will indicate the possibility of success."),
                                        "id"      => "textarea_id",
                                        "std"     => __("You do not have to put any defaults"),
                                        "type"    => "textarea",
                                        "rows" => "2",
                                        "cols" => "55"
                                        ),

                        array(    "name"    => __('PLUGIN Select'),
                                        "desc"    => __("There are many choices awaiting"),
                                        "id"      => "TEST_SELECT",
                                        "default" => "Select 4",
                                        "type"    => "select",
                                        "options" => array(
                                                            "Select 1",
                                                            "Select 2",
                                                            "Select 3",
                                                            "Select 4",
                                                            "Select 5"
                                                            )
                                        ),

                        array(  "name"  => __('PLUGIN Asides Category'),
                                "desc"  => __('Pick the category to use as your sideblog'),
                                "id"    => "TEST_ASIDES_CATEGORY_SELECTOR",
                                "type"  => "select_wp_categories",
                                "args" => array(

                                                            )
                                ),

                        array(  "name"  => __('PLUGIN Featured Page'),
                                "desc"  => __('Choose the page to feature'),
                                "id"    => "TEST_PAGE_SELECTOR",
                                "type"  => "select_wp_pages",
                                "args" => array(

                                                            )
                                ),

                        array(    "name"    => __('PLUGIN MultiSelect'),
                                        "desc"    => __("There are many choices awaiting and you can have them all"),
                                        "id"      => "TEST_MULTISELECT",
                                        "default"     => "Select 5",
                                        "type"    => "select",
                                        "multi"   => TRUE,
                                        "size"   => "8",
                                        "options" => array(
                                                            "Select 1",
                                                            "Select 2",
                                                            "Select 3",
                                                            "Select 4",
                                                            "Select 5",
                                                            "Select 6",
                                                            "Select 7",
                                                            "Select 8"
                                                            )
                                        )
                        )

                    );
        $kst_plugin_dev_test_plugin->options->add($kst_plugin_dev_test_options);

        // Add Help
        $kst_plugin_dev_test_help = array(
                array (
                    'title' => 'Excerpts and teasers',
                    'page' => 'WordPress',
                    'section' => 'Blog Posts',
                    'content_source' => "<p>This is a sample entry created by the dev test plugin.<br />It exists only to ensure backwards compatibility during development.</p>"
                    )
            );
        $kst_plugin_dev_test_plugin->help->add($kst_plugin_dev_test_help);



} else {
    // Needs to check if it is in the admin section OR in the login page (login is not in the admin)
    if ( is_admin() ) {
        // Give an admin notice to let them know what is going on in the admin
        add_action('admin_notices', 'make_sure'); // Insert notice hook
        function make_sure() { // Outputs some help info and a download link
            if ( substr( $_SERVER["PHP_SELF"], -11 ) == 'plugins.php' && !class_exists('KST') ) {
                echo "<div class='error'><p>The <strong>{$GLOBALS['kst_plugin_dev_test_settings']['friendly_name']}</strong> plugin requires the KST base plugin.<br /><a href='#'>Download and install KST Base</a></p></div>";
            }
        }
        return;
    } else {
        // Having a FUN and useful help message would be cool.
        echo "<h1>Pretty cool!<br />You are using a Kitchen Sink based WordPress plugin<br />HOWEVER...</h1><p>...you have not activated the Kitchen Sink HTML5 Base plugin in WordPress OR you haven't included it as library in your theme.<br />See the <a href='http://beingzoe.com/zui/wordpress/kitchen_sink/'>documentation</a> if you need assistance.</p><p><a href='#'>Sign in</a> to WordPress.";
        exit;
    }
}
