<?php
/**
 * Main entry point to plugin
 *
 * @since             1.0.0
 * @package           Socialise
 *
 * @wordpress-plugin
 * Plugin Name:       Socialise
 * Version:           1.0.0
 * Author:            Luca Spiller
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       socialise
 * Domain Path:       /languages
 *
 * Copyright (C) 2015 Blissful Systems Limited
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_socialise() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-networks.php';

	$networks = new Socialise\Networks();

	if ( is_admin() ) {

		// Load the admin class.
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-admin.php';

		$admin = new Socialise\Admin( $networks );
		$admin->register();

	} else {

		// Load the frontend class.
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-frontend.php';

		$assets_url = plugins_url( 'assets/', __FILE__ );

		$frontend = new Socialise\Frontend( $networks, $assets_url );
		$frontend->register();

	}
}

run_socialise();

?>
