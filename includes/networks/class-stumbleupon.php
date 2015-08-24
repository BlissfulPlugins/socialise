<?php
/**
 * StumbleUpon functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * StumbleUpon functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
class StumbleUpon extends Base {

	/**
	 * Set slug and name.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->network_slug = 'stumbleupon';
		$this->network_name = 'StumbleUpon';

	}

	/**
	 * Returns the share URL.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_share_url() {

		// TODO we should also look for any images in the post to 'pin', these can
		// be provided via the 'media' parameter.
		$url = 'https://www.stumbleupon.com/submit?';
		$url .= 'url=' . urlencode( get_the_permalink() ) . '&';
		$url .= 'title=' . rawurlencode( $this->get_truncated_title( 200 ) );

		return $url;

	}

}

(new StumbleUpon())->register();

?>
