<?php
/**
 * LinkedIn functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */

namespace Socialise\Networks;

/**
 * LinkedIn functionality.
 *
 * @since 1.0.0
 * @package Socialise
 */
class LinkedIn extends Base {

	/**
	 * Set slug and name.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->network_slug = 'linkedin';
		$this->network_name = 'LinkedIn';

	}

	/**
	 * Returns the share URL.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function get_share_url() {

		$url = 'https://www.linkedin.com/shareArticle?';
		$url .= 'url=' . urlencode( get_the_permalink() ) . '&';
		$url .= 'mini=true&';
		$url .= 'title=' . rawurlencode( $this->get_truncated_title( 200 ) ) . '&';
		$url .= 'source=' . rawurlencode( get_bloginfo( 'name' ) );

		return $url;

	}

}

(new LinkedIn())->register();

?>
