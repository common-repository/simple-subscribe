<?php
/*
    Plugin Name: Simple Subscribe
    Description: The easiest to use subscribe plugin, just for you :)
    Author: latorante, tanaylakhani
    Author URI: http://plugins.readygraph.com
    Author Email: info@readygraph.com
    Version: 2.1
    License: GPLv2
*/
/*
    Copyright 2013  ReadyGraph  (email : info@readygraph.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * 1. If no Wordpress, go home
 */
global $wpdb, $wp_version;
if (!defined('ABSPATH')) { exit; }
//define("WP_ssubscribe_TABLE_APP", $wpdb->prefix . "ssubscribe_app");

/**
 * 2. Check minimum requirements (wp version, php version)
 * Reason behind this is, we just need PHP 5.3.1 at least,
 * and wordpress 3.3 or higher. We just can't run the show
 * on some outdated installation.
 */

require_once('SimpleSubscribeCheck.php');
SimpleSubscribeCheck::checkRequirements();

/**
 * 3. Activation / deactivation
 */

register_activation_hook(__FILE__,      array('SimpleSubscribe', 'activate'));
register_deactivation_hook( __FILE__,   array('SimpleSubscribe', 'deactivate'));

define( 'SS_VERSION', '2.1' );

if (get_option('SS_VERSION') && strlen(get_option('SS_VERSION')) > 0){
	if (get_option('SS_VERSION') !== SS_VERSION ) {
		add_action('shutdown', 'ss_update');
	}
} else { 
update_option('SS_VERSION', SS_VERSION);	
}
if (!function_exists('ss_update')) {
	function ss_update() {
		///plugin version check and upgrade code
	}
}

