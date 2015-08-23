<?php
/**
 * Handles loading and initialising networks.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise;

/**
 * Handles loading and initialising networks.
 *
 * @since 1.0.0
 * @package Socialise
 */
class Networks {
	/**
	 * Whether or not we have already loaded the default (built-in) social networks.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      boolean    $loaded_default_networks
	 */
	protected $loaded_default_networks;

	/**
	 * Get the list of loaded networks. We require the default social networks,
	 * and any extras should be included as plugins that should be loaded and
	 * hence registered in the 'socialise_get_networks' filter by now.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function get_networks() {

		if ( ! $this->loaded_default_networks ) {
			$this->load_default_networks();
		}

		return apply_filters( 'socialise_get_networks', array() );

	}

	/**
	 * Load the default (built-in) social networks.
	 *
	 * @since    1.0.0
	 * @access   protected
	 */
	protected function load_default_networks() {

		$glob_path = plugin_dir_path( __FILE__ ) . 'networks/*.php';

		foreach ( glob( $glob_path ) as $filename ) {
			require_once $filename;
		}

		$this->loaded_default_networks = true;

	}
}

?>
