<?php
/**
 * GooglePlus functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * GooglePlus functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
class GooglePlus extends Base {

	/**
	 * Set slug and name.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->network_slug = 'google-plus';
		$this->network_name = 'Google+';

	}

	/**
	 * Returns the share URL.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_share_url() {

		return 'https://plus.google.com/share?url=' . urlencode( get_the_permalink() );

	}

}

(new GooglePlus())->register();

?>
