<?php
/**
 * The render functionality of the plugin.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise;

/**
 * The render functionality of the plugin.
 *
 * @since 1.0.0
 */
class Renderer {

	protected $networks;

	protected $assets_url;

	public function __construct( $networks, $assets_url) {

		$this->networks   = $networks;
		$this->assets_url = $assets_url;

	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_style( 'socialise-renderer', $this->assets_url . 'css/socialise.css' );
		wp_enqueue_style( 'socialise-icons', $this->assets_url . 'css/socialise-icons.css' );
		wp_enqueue_script( 'socialise-renderer', $this->assets_url . 'js/socialise.js', array( 'jquery' ) );

	}

	/**
	 * Renders the widget to HTML.
	 *
	 * @since 1.0.0
	 */
	public function render() {

		include plugin_dir_path( __FILE__ ) . 'templates/render.php';

	}

	public function get_networks() {

		$network_renderers = array();

		foreach ( $this->networks->get_networks() as $network ) {

			$network_renderers[] = new NetworkRenderer( $network );

		}

		return $network_renderers;

	}

	/**
	 * Renders the widget on a post.
	 *
	 * @since 1.0.0
	 * @param string $content Post content.
	 */
	public function render_on_post ( $content ) {

		return $content . "\n" . $this->render();

	}
}

class NetworkRenderer {

	protected $network;

	public function __construct( $network ) {

		$this->network = $network;

	}

	public function get_slug() {

		return $this->network->get_slug();

	}

	public function get_name() {

		return $this->network->get_name();

	}

	public function is_enabled() {

		return $this->network->is_enabled();

	}

	public function html_li_tag() {

		echo '<li class="socialise-' . $this->network->get_slug() . '">';

	}

	public function html_link_tag() {

		echo '<a href="' . esc_attr( $this->network->get_share_url() ) . '" target="_blank">';

	}
}

?>
