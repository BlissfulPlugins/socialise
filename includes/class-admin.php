<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise;

/**
 * The admin-specific functionality of the plugin.
 *
 * @since 1.0.0
 */
class Admin {

	protected $networks;

	protected $assets_url;

	public function __construct( $networks, $assets_url ) {

		$this->networks   = $networks;
		$this->assets_url = $assets_url;

	}

	/**
	 * Register admin hooks.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Admin hooks to add our menus.
		add_action( 'admin_init', array( $this, 'admin_init_callback' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu_callback' ) );

	}

	/**
	 * Callbacks for the admin_init action.
	 *
	 * @since 1.0.0
	 */
	public function admin_init_callback() {

		wp_enqueue_style( 'socialise-icons', $this->assets_url . 'css/socialise-icons.css' );
		wp_enqueue_style( 'socialise-admin', $this->assets_url . 'css/socialise-admin.css' );

		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'socialise-admin', $this->assets_url . 'js/socialise-admin.js', array( 'jquery', 'jquery-ui-sortable' ) );

		foreach ( $this->networks->get_networks() as $network ) {

			$network->register_settings();

		}

	}

	/**
	 * Callbacks for the admin_menu action.
	 *
	 * @since 1.0.0
	 */
	public function admin_menu_callback() {

		add_menu_page( 'Socialise', 'Socialise', 'manage_options', 'socialise_options', array( $this, 'render_options' ) );
		add_submenu_page( 'socialise_options', 'Options', 'Options', 'manage_options', 'socialise_options', array( $this, 'render_options' ) );

	}

	/**
	 * Render admin options page
	 *
	 * @since    1.0.0
	 */
	function render_options() {

		include plugin_dir_path( __FILE__ ) . 'templates/admin.php';

	}
}

?>
