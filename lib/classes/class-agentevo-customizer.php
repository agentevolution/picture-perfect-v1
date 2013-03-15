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
add_action( 'wp_head'               , array( 'Agentevo_Theme_Options', 'render'              ) );
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
	public static function register($wp_customize)
	{
		# Sections
		# ==========================================================================

		$wp_customize->add_section(
			'general_settings',
			array(
				'title'    => __('General Settings', 'agentevo'),
				'priority' => 35,
			)
		);


		# Settings & Controls
		# ==========================================================================


		/* General Settings
		-----------------------------------------------*/

		$wp_customize->add_setting(
			'default_background_image',
			array(
				'default' => get_stylesheet_directory_uri() . '/images/PicturePerfect.jpg'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'default_background_image',
				array(
					'label'    => __('Default background image', 'agentevo'),
					'section'  => 'general_settings',
					'priority' => 1
				)
			)
		);
	}


	/**
	 * This will output the custom WordPress settings to the theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see add_action('wp_head',$func)
	 */
	public static function render()
	{
		?>
		<!-- BEGIN CUSTOMIZER CSS -->
		<style>
		<?php
		self::generate_css(
			'body',
			'background',
			'default_background_image',
			'url(',
			') no-repeat center center fixed'
		);
		?>
		</style>
		<?php
	}


	/**
	 * Generates a line of CSS for use in header output.
	 *
	 * If the setting ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 *
	 * @param string $selector CSS selector
	 * @param string $style The name of the CSS property to modify
	 * @param string $mod_name The name of the theme_mod option to fetch
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool $echo Optional. Whether to print directly to the page (default: true).
	 *
	 * @return string Returns a single line of CSS with selectors and a property.
	 */
	public static function generate_css($selector, $style, $mod_name, $prefix='', $postfix='', $echo=true)
	{
		$mod = get_theme_mod($mod_name);

		if ( empty($mod) ) {
			return '';
		}

		$output = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix . $mod . $postfix
		);

		$output .= "\n";

		if ( $echo ) {
			echo $output;
		}

		return $output;
	}
}