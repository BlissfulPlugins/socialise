<?php
/**
 * Pinterest functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * Pinterest functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
class Pinterest extends Base {

	/**
	 * Set slug and name.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->network_slug = 'pinterest';
		$this->network_name = 'Pinterest';

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
		$url = 'https://www.pinterest.com/pin/create/button/?';
		$url .= 'url=' . urlencode( get_the_permalink() ) . '&';
		$url .= 'description=' . rawurlencode( $this->get_truncated_title( 200 ) );

		return $url;

	}

}

(new Pinterest())->register();

?>
