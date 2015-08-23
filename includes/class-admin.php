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

	public function __construct( $networks ) {

		$this->networks = $networks;

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

		wp_enqueue_style( 'socialise-admin-css', plugin_dir_url( __FILE__ ) . '../css/socialise-admin.css' );

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
?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Socialise Options', 'socialise' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'socialise_options' ); ?>
			<?php do_settings_sections( 'socialise_options' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
	}
}

?>
