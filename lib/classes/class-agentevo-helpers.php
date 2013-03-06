<?php
/**
 * Helpers
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Helpers
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/licenses/gpl-2.0.html GPL
 * @link     http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}

class Agentevo_Helpers
{
	/**
	 * Returns the client info according to the $info param
	 *
	 * @param string $info the option to return
	 * @return string
	 */
	public function get_agent_info($info)
	{
		if ( 'youtube_url' == $info ) {

			return genesis_get_option('youtube_url');

		} elseif ('facebook_url' == $info ) {

			return genesis_get_option('facebook_url');

		} elseif ( 'twitter_url' == $info ) {

			return 'http://twitter.com/' . genesis_get_option('twitter_handle');

		} elseif ( 'pinterest_url' == $info ) {

			return genesis_get_option('pinterest_url');

		} elseif ( 'linkedin_url' == $info ) {

			return genesis_get_option('linkedin_url');

		} elseif ( 'googleplus_url' == $info ) {

			return genesis_get_option('googleplus_url');

		} elseif ( 'address' == $info ) {

			return genesis_get_option('agent_address');

		} elseif ( 'phone' == $info ) {

			return genesis_get_option('agent_phone');

		} elseif ( 'email' == $info ) {

			return genesis_get_option('agent_email');

		} else {
			# none found
			return '';
		}
	}


	/**
	 * Returns an array of social links
	 *
	 * @return array
	 */
	public function get_social_links()
	{
		return array(
			'youtube'     => $this->get_agent_info('youtube_url'),
			'facebook'    => $this->get_agent_info('facebook_url'),
			'twitter'     => $this->get_agent_info('twitter_url'),
			'pinterest'   => $this->get_agent_info('pinterest_url'),
			'linkedin'    => $this->get_agent_info('linkedin_url'),
			'google-plus' => $this->get_agent_info('googleplus_url'),
			'email'       => $this->get_agent_info('email')
		);
	}
}

$_ae = new Agentevo_Helpers;