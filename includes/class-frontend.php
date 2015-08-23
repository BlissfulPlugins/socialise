<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise;

/**
 * The frontend-specific functionality of the plugin.
 *
 * @since 1.0.0
 */
class Frontend {

	protected $networks;

	protected $assets_url;

	protected $renderer;

	public function __construct( $networks, $assets_url ) {

		$this->networks   = $networks;
		$this->assets_url = $assets_url;

	}

	/**
	 * Register frontend hooks.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// TODO allow the renderer to be confiured.
		require_once plugin_dir_path( __FILE__ ) . 'class-renderer.php';

		$this->renderer = new Renderer( $this->networks, $this->assets_url );

		// Add our renderer.
		add_filter( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'the_content', array( $this, 'render_on_post' ), 50 );

	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	function enqueue_scripts() {

		return $this->renderer->enqueue_scripts();

	}

	/**
	 * Render the widget on a post.
	 *
	 * @since 1.0.0
	 * @param string $content Post content.
	 * @return string Post content with socialise widget.
	 */
	function render_on_post( $content ) {

		return $this->renderer->render_on_post( $content );

	}
}

?>
