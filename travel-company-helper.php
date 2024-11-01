<?php
/**
 * @package Travel_Company_Helper
 */
/*
Plugin Name: Travel Company Helper
Description: Used for Travel Company theme for frontpage section and custom post type service.
Version: 1.0.5
Author: scorpionthemes
Author URI: http://www.scorpionthemes.com/
License: GPLv2 or later
Text Domain: travel-company-helper
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2018 Automattic, Inc.
*/

//If this file is ccalled directly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You idiot man!' );


/**
 * The code that runs during plugin activation
 */
function activate_travel_company_helper_plugin() {
	require_once('inc/Activate.php');
}
register_activation_hook( __FILE__, 'activate_travel_company_helper_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_travel_company_helper_plugin() {
	require_once('inc/Deactivate.php');
}
register_deactivation_hook( __FILE__, 'deactivate_travel_company_helper_plugin' );


require_once('inc/RepeaterController.php');

require_once('custom-post-types.php');

require_once('travel-company-helper-function.php');

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}