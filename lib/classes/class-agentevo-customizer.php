<?php
/**
 * Customizer
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Admin
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/licenses/gpl-2.0.html GPL
 * @link     http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}

add_action( 'customize_register'    , array( 'Agentevo_Theme_Options', 'register'            ) );
// add_action( 'init'                  , array( 'Agentevo_Theme_Options', 'remove_all_mods'     ) );
// add_action( 'init'                  , array( 'Agentevo_Theme_Options', 'remove_section_mods' ) );
// add_action( 'wp_head'               , array( 'Agentevo_Theme_Options', 'render'              ) );
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class Agentevo_Theme_Options
{

	/**
	 * Registers the settings with WordPress.
	 *
	 * Used by hook: 'customize_register'
	 *
	 * @see add_action('customize_register', $func)
	 * @param WP_Customize_Manager $wp_customize
	 */
	public static function register( $wp_customize )
	{
		
	}
}