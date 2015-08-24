<?php
/**
 * Twitter functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * Twitter functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
class Twitter extends Base {

	/**
	 * Set slug and name.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->network_slug = 'twitter';
		$this->network_name = 'Twitter';

	}

	/**
	 * Register admin settings (called in the 'admin_init' WP action).
	 *
	 * @since 1.0.0
	 * @package Socialise
	 */
	public function register_settings() {

		parent::register_settings();

		add_settings_section(
			'socialise_twitter_section',
			$this->network_name,
			null,
			'socialise_options'
		);

		add_settings_field(
			'socialise_twitter_hashtags',
			'Hashtags',
			array( $this, 'render_hashtags_field' ),
			'socialise_options',
			'socialise_twitter_section'
		);

		add_settings_field(
			'socialise_twitter_via',
			'Via',
			array( $this, 'render_via_field' ),
			'socialise_options',
			'socialise_twitter_section'
		);

		register_setting( 'socialise_options', 'socialise_twitter_hashtags' );
		register_setting( 'socialise_options', 'socialise_twitter_via' );

	}

	/**
	 * Render the hashtags admin field.
	 *
	 * @since 1.0.0
	 * @package Socialise
	 */
	function render_hashtags_field() {
		$setting = get_option( 'socialise_twitter_hashtags' );

		echo '<input type="text" id="socialise_twitter_hashtags" name="socialise_twitter_hashtags" value="' . esc_attr( $setting ) . '" />';
	}

	/**
	 * Render the via admin field.
	 *
	 * @since 1.0.0
	 * @package Socialise
	 */
	function render_via_field() {
		$setting = get_option( 'socialise_twitter_via' );

		echo '<input type="text" id="socialise_twitter_via" name="socialise_twitter_via" value="' . esc_attr( $setting ) . '" />';
	}

	/**
	 * Returns the share URL.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_share_url() {

		$max_length = 140;

		$hashtags_option = get_option( 'socialise_twitter_hashtags' );
		$via_option      = get_option( 'socialise_twitter_via' );

		$url = 'https://twitter.com/intent/tweet?';

		if ( ! empty( $hashtags_option ) ) {

			$url .= 'hashtags=' . urlencode( $hashtags_option ) . '&';

			// Formats hashtags, e.g. one,two -> #one #two.
			$hashtags_text = ' #' . implode( ' #', preg_split( '/,[\s]+/', $hashtags_option ) );
			$max_length -= strlen( $hashtags_text );

		}

		if ( ! empty( $via_option ) ) {

			$url .= 'via=' . urlencode( $via_option ) . '&';

			$via_text = ' via @' . $via_option;
			$max_length -= strlen( $via_text );

		}

		$url .= 'url=' . urlencode( get_the_permalink() ) . '&';
		$url = str_replace( '.dev', '.com', $url );

		// This is the short url length, see
		// https://dev.twitter.com/rest/reference/get/help/configuration.
		$max_length -= 24;

		// Text parameter - the prefilled Tweet body.
		$url .= 'text=' . rawurlencode( $this->get_truncated_title( $max_length ) );

		return $url;

	}

}

(new Twitter())->register();

?>
