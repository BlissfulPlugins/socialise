<?php
/**
 * Facebook functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * Facebook functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
class Facebook extends Base {

	/**
	 * Set slug and name.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->network_slug = 'facebook';
		$this->network_name = 'Facebook';

	}

	/**
	 * Returns the share URL.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_share_url() {

		// TODO sharer.php no longer accepts custom post paramters (e.g title) and just retries the OG
		// params for the page. The modern way is to use the share dialog, but that requires the user
		// to have registered an app on Facebook - we should support both.
		return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_the_permalink() );

	}

}

(new Facebook())->register();

?>
