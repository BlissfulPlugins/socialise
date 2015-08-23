<?php
/**
 * Abstract base class for shared network functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * Abstract base class for shared network functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
abstract class Base {
	/**
	 * The unique identifier of this network.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $network_slug
	 */
	protected $network_slug;

	/**
	 * The name of this network.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $network_name
	 */
	protected $network_name;

	/**
	 * Getter for $slug
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_slug() {

		return $this->network_slug;

	}

	/**
	 * Getter for $network_name
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_name() {

		return $this->network_name;

	}

	/**
	 * Returns whether or not this network is enabled.
	 *
	 * @since    1.0.0
	 * @return   bool
	 */
	public function is_enabled() {

		return ( '1' === get_option( 'socialise_' . $this->network_slug . '_enabled' ) );

	}

	/**
	 * Hook into socialise_get_networks to register this network.
	 *
	 * @since    1.0.0
	 */
	public function register() {

		add_filter( 'socialise_get_networks', array( $this, 'get_networks_filter' ) );

	}

	/**
	 * Callback to add this network to the list of registered network.
	 *
	 * @since    1.0.0
	 * @param    array $networks List of networks without this.
	 * @return   array $networks List of networks with this.
	 */
	public function get_networks_filter($networks) {

		$networks[] = $this;
		return $networks;

	}

	/**
	 * Registers settings in the WP Settings API.
	 *
	 * Extend this in the sub-class to add more settings, e.g.:
	 *
	 *     public function register_settings() {
	 *
	 *       parent::register_settings();
	 *
	 *       // your settings
	 *
	 *     }
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		register_setting( 'socialise_options', 'socialise_' . $this->network_slug . '_enabled' );

		add_settings_section(
			'socialise_' . $this->network_slug . '_section',
			$this->network_name,
			null,
			'socialise_options'
		);

		add_settings_field(
			'socialise_' . $this->network_slug . '_enabled',
			'Enabled',
			array( $this, 'render_settings_enabled_field' ),
			'socialise_options',
			'socialise_' . $this->network_slug . '_section'
		);

	}

	/**
	 * Callback to render the enabled field
	 *
	 * @since    1.0.0
	 */
	public function render_settings_enabled_field() {

		echo '<label><input name="socialise_' . esc_attr( $this->network_slug ) . '_enabled" id="socialise_' . esc_attr( $this->network_slug ) . '_enabled" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'socialise_' . $this->network_slug . '_enabled' ), false ) . ' />' . esc_html__( 'Enable sharing on this network', 'socialise' ) . '</label>';

	}

	/**
	 * Returns the share URL for this network. This should be implemented in the
	 * sub-class.
	 *
	 * This URL is opened when the user clicks the share button for this network.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	abstract public function get_share_url();

	/**
	 * Truncates the post title to a specified length.
	 *
	 * @since    1.0.0
	 * @return   string
	 * @param    integer $max_length The maximum length the title can be.
	 */
	protected function get_truncated_title( $max_length = null ) {

		// Gets the title without curly quotes / wptexturize.
		$post = get_post();
		$title = isset( $post->post_title ) ? $post->post_title : '';

		if ( strlen( $title ) <= $max_length ) {

			// No truncation needed.
			return $title;

		} else {

			$title = substr( $title, 0, $max_length );

			// Try and break at the end of a sentence.
			if ( false !== ( $breakpoint = strrpos( $title, '.' ) ) ) {

				$title = substr( $title, 0, $breakpoint + 1 );

			} else {

				// Otherwise try and break on a space, and add elipsis.
				$title = substr( $title, 0, $max_length - 1 );

				if ( false !== ( $breakpoint = strrpos( $title, ' ' ) ) ) {

					$title = substr( $title, 0, $breakpoint ) . '…';

				}
			}

			return $title;

		}

	}

}
