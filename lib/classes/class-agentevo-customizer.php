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
add_action( 'init'                  , array( 'Agentevo_Theme_Options', 'remove_all_mods'     ) );
add_action( 'init'                  , array( 'Agentevo_Theme_Options', 'remove_section_mods' ) );
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
	 *
	 * @return void
	 */
	public static function register($wp_customize)
	{
		# Sections
		# ==========================================================================

		# General Settings
		$wp_customize->add_section(
			'general_settings',
			array(
				'title'    => __('General Settings', 'agentevo'),
				'priority' => 35,
			)
		);

		# Text Colors
		$wp_customize->add_section(
			'text_colors',
			array(
				'title'    => __('Text Colors', 'agentevo'),
				'priority' => 36,
			)
		);


		# Background Colors
		$wp_customize->add_section(
			'background_colors',
			array(
				'title'    => __('Background Colors', 'agentevo'),
				'priority' => 37,
			)
		);


		# Buttons
		$wp_customize->add_section(
			'buttons',
			array(
				'title'    => __('Buttons', 'agentevo'),
				'priority' => 38,
			)
		);


		# Options
		$wp_customize->add_section(
			'options',
			array(
				'title'    => __('Options', 'agentevo'),
				'priority' => 39,
			)
		);


		# Settings & Controls
		# ==========================================================================


		/* Title Tagline Settings
		-----------------------------------------------*/

		$wp_customize->add_setting(
			'logo_image',
			array('default' => get_stylesheet_directory_uri() . '/images/logo.png')
		);


		$wp_customize->add_setting(
			'logo_display_type',
			array('default' => 'image')
		);

		$wp_customize->add_setting('site_title_desc_color');


		# LOGO DISPLAY TYPE
		$wp_customize->add_control(
			'logo_display_type',
			array(
			'label'      => __('Logo Display Type', 'agentevo' ),
			'section'    => 'title_tagline',
			'settings'   => 'logo_display_type',
			'priority'   => 1,
			'type'       => 'radio',
			'choices'    => array(
				'image'  => 'Custom Image',
				'text'   => 'Use site title and tagline as logo'
			)
		) );


		# LOGO IMAGE
		# This never gets rendered here but it is used in frontend.php
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'logo_image',
				array(
					'label'    => __('Logo Image - Suggested Dimensions are 294 X 117', 'agentevo'),
					'section'  => 'title_tagline',
					'priority' => 2
				)
			)
		);


		# SITE TITLE DESCRIPTION COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'site_title_desc_color',
				array(
					'label'    => __('Site Title and Description Color', 'agentevo'),
					'section'  => 'title_tagline',
					'priority' => 3
				)
			)
		);


		/* General Settings
		-----------------------------------------------*/

		$wp_customize->add_setting(
			'default_background_image'
		);


		# This never gets rendered here but it is used in frontend.php
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


		/* Text Colors
		-----------------------------------------------*/

		$wp_customize->add_setting('text_color');
		$wp_customize->add_setting('link_color');
		$wp_customize->add_setting('link_hover_color');
		$wp_customize->add_setting('nav_link_color');
		$wp_customize->add_setting('nav_link_hover_color');
		$wp_customize->add_setting('footer_text_color');
		$wp_customize->add_setting('icon_color');


		# TEXT COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'text_color',
				array(
					'label'    => __('Standard Text Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 1
				)
			)
		);


		# LINK COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'link_color',
				array(
					'label'    => __('Inline Link Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 2
				)
			)
		);


		# LINK HOVER COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'link_hover_color',
				array(
					'label'    => __('Inline Link Hover Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 3
				)
			)
		);


		# NAV LINK COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nav_link_color',
				array(
					'label'    => __('Nav Link Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 4
				)
			)
		);


		# NAV LINK HOVER COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nav_link_hover_color',
				array(
					'label'    => __('Nav Link Hover Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 5
				)
			)
		);


		# FOOTER TEXT COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_text_color',
				array(
					'label'    => __('Footer Text Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 6
				)
			)
		);


		# ICON COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'icon_color',
				array(
					'label'    => __('Default Icon Color', 'agentevo'),
					'section'  => 'text_colors',
					'priority' => 7
				)
			)
		);


		/* Background Colors
		-----------------------------------------------*/

		$wp_customize->add_setting('content_bg');
		$wp_customize->add_setting('nav_footer_bg');
		$wp_customize->add_setting('border_color');


		# CONTENT BACKGROUND
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'content_bg',
				array(
					'label'    => __('Content Background', 'agentevo'),
					'section'  => 'background_colors',
					'priority' => 1
				)
			)
		);


		# TOP NAV & FOOTER BACKGROUND
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'nav_footer_bg',
				array(
					'label'    => __('Top Nav & Footer Background', 'agentevo'),
					'section'  => 'background_colors',
					'priority' => 2
				)
			)
		);


		# BORDER COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'border_color',
				array(
					'label'    => __('Border Color', 'agentevo'),
					'section'  => 'background_colors',
					'priority' => 3
				)
			)
		);


		/* Buttons
		-----------------------------------------------*/

		$wp_customize->add_setting('primary_button_bg');
		$wp_customize->add_setting('primary_button_border');
		$wp_customize->add_setting('primary_button_textcolor');
		$wp_customize->add_setting('primary_button_textshadow');

		$wp_customize->add_setting('alt_button_bg');
		$wp_customize->add_setting('alt_button_border');
		$wp_customize->add_setting('alt_button_textcolor');
		$wp_customize->add_setting('alt_button_textshadow');


		# PRIMARY BUTTON BG
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_button_bg',
				array(
					'label'    => __('Primary Button Background', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 1
				)
			)
		);


		# PRIMARY BUTTON BORDER
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_button_border',
				array(
					'label'    => __('Primary Button Border', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 2
				)
			)
		);


		# PRIMARY BUTTON TEXTCOLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_button_textcolor',
				array(
					'label'    => __('Primary Button Text Color', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 3
				)
			)
		);


		# PRIMARY BUTTON TEXTSHADOW
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_button_textshadow',
				array(
					'label'    => __('Primary Button Text Shadow', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 4
				)
			)
		);


		# ALT BUTTON BG
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'alt_button_bg',
				array(
					'label'    => __('Alt Button Background', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 5
				)
			)
		);


		# ALT BUTTON BORDER
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'alt_button_border',
				array(
					'label'    => __('Alt Button Border', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 6
				)
			)
		);


		# ALT BUTTON TEXT COLOR
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'alt_button_textcolor',
				array(
					'label'    => __('Alt Button Text Color', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 7
				)
			)
		);


		# ALT BUTTON TEXT SHADOW
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'alt_button_textshadow',
				array(
					'label'    => __('Alt Button Text Shadow', 'agentevo'),
					'section'  => 'buttons',
					'priority' => 8
				)
			)
		);


		/* Options
		--------------------------------------------------*/

		$wp_customize->add_setting('remove_all_mods');
		$wp_customize->add_setting('remove_section_mods');

		// Remove All Mods
		$wp_customize->add_control( 'remove_all_mods', array(
			'label'      => __( 'Remove All Customizations', 'agentevo' ),
			'section'    => 'options',
			'settings'   => 'remove_all_mods',
			'type'       => 'checkbox'
		) );

		// Remove mods by section
		$wp_customize->add_control( 'remove_section_mods', array(
			'label'      => __( 'Remove Customizations By Section. Select one, press save, and refresh the page to see the changes.', 'agentevo' ),
			'section'    => 'options',
			'settings'   => 'remove_section_mods',
			'type'       => 'radio',
			'choices'    => array(
				'title_tagline'     => 'Site Title & Tagline',
				'general_settings'  => 'General Settings',
				'text_colors'       => 'Text Colors',
				'background_colors' => 'Background Colors',
				'buttons'           => 'Buttons',
			)
		) );
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
		echo '<!-- BEGIN CUSTOMIZER CSS -->';
		echo '<style>';

		# TEXT COLOR
		self::generate_css(
			'
			body,
			button,
			input,
			select,
			textarea,
			p,
			.home .home-right .menu li a,
			.post h2.entry-title a,
			h1.entry-title,
			h2 a,
			h4 a',
			'color',
			'text_color'
		);


		# SITE TITLE DESC COLOR
		self::generate_css(
			'.site-title-description-container .site-title a,
			.site-title-description-container .site-description',
			'color',
			'site_title_desc_color'
		);


		# LINK COLOR
		self::generate_css(
			'a, a:visited',
			'color',
			'link_color'
		);


		# LINK HOVER COLOR
		self::generate_css(
			'a:hover, a:focus',
			'color',
			'link_hover_color'
		);


		# NAV LINK COLOR
		self::generate_css(
			'nav.primary li a',
			'color',
			'nav_link_color'
		);

		# NAV LINK BORDER COLOR
		self::generate_css(
			'nav.primary li a:after',
			'background',
			'nav_link_color'
		);


		# NAV LINK HOVER COLOR
		self::generate_css(
			'.primary li a:hover,.primary li a:active,.primary li .current_page_item a,.primary li .current-cat a,.primary li .current-menu-item a',
			'color',
			'nav_link_hover_color'
		);


		# FOOTER TEXT COLOR
		self::generate_css(
			'.site-footer, .site-footer p, .site-footer .credits a, .site-footer .agent-social-icons a, .site-footer .agent-social-icons a:visited, .site-footer i[class^="icon-"]',
			'color',
			'footer_text_color'
		);


		# ICON COLOR
		self::generate_css(
			'.agent-social-icons a, .agent-social-icons a:visited, i[class^="icon-"]',
			'color',
			'icon_color'
		);


		# Render the content background with opacity using RGBA
		if (get_theme_mod('content_bg')) {
			echo '
			.home .home-right,
			#inner {
				background: ' . get_theme_mod('content_bg') . ';
				background: rgba(' . self::hex2rgb(get_theme_mod('content_bg')) . ', 0.9);
			}';	
		}
		

		# NAV/FOOTER BACKGROUND
		self::generate_css(
			'nav.primary, .site-footer, nav.primary ul',
			'background',
			'nav_footer_bg'
		);


		# BORDER COLOR
		self::generate_css(
			'.sidebar .widget,
			.sidebar .site-title-description-container,
			#footer-widgets,
			.home .home-right .menu li a,
			.sidebar .menu li.has-icon a,
			.clear-line',
			'border-color',
			'border_color'
		);


		# LOGO IMAGE
		self::generate_css(
			'body .site-title',
			'background',
			'logo_image',
			'url(',
			') no-repeat center top; background-size: contain'
		);


		$primary_button_classes = '
		div.gform_footer input.button, div.gform_footer input.button:hover,
		.listing-wrap .more-link, .listing-wrap .more-link:hover,
		input[type="submit"], input[type="submit"]:hover,
		input[type="button"],
		.enews #subbutton,
		.reply a, .reply a:visited, .reply a:hover,
		.searchsubmit, .searchsubmit:hover,
		#submit, #submit:hover,
		.btn-primary, .btn-primary:visited, .btn-primary:hover';

		# PRIMARY BUTTON BG
		self::generate_css(
			$primary_button_classes,
			'background',
			'primary_button_bg'
		);


		# PRIMARY BUTTON BORDER
		self::generate_css(
			$primary_button_classes,
			'border-color',
			'primary_button_border'
		);


		# PRIMARY BUTTON TEXT COLOR
		self::generate_css(
			$primary_button_classes,
			'color',
			'primary_button_textcolor'
		);


		# PRIMARY BUTTON TEXT SHADOW
		self::generate_css(
			$primary_button_classes,
			'text-shadow',
			'primary_button_textshadow',
			'1px 1px '
		);


		$alt_button_classes = 'input.btn-alt, .btn-alt, .btn-alt:visited, .btn-alt:hover';

		# ALT BUTTON BG
		self::generate_css(
			$alt_button_classes,
			'background',
			'alt_button_bg'
		);


		# ALT BUTTON BORDER
		self::generate_css(
			$alt_button_classes,
			'border-color',
			'alt_button_border'
		);


		# ALT BUTTON TEXT COLOR
		self::generate_css(
			$alt_button_classes,
			'color',
			'alt_button_textcolor',
			'',
			' !important'
		);


		# ALT BUTTON TEXT SHADOW
		self::generate_css(
			$alt_button_classes,
			'text-shadow',
			'alt_button_textshadow',
			'1px 1px '
		);


		echo '</style>';
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


	/**
	 * Returns an array of mod sections and mods ids
	 *
	 * @return array
	 */
	public static function get_sections_with_mods()
	{
		return array(

			'title_tagline' => array(
				'logo_image',
				'logo_display_type',
				'site_title_desc_color',
			),

			'general_settings' => array(
				'default_background_image',
			),

			'text_colors' => array(
				'text_color',
				'link_color',
				'link_hover_color',
				'nav_link_color',
				'nav_link_hover_color',
				'footer_text_color',
				'icon_color',
			),

			'background_colors' => array(
				'content_bg',
				'nav_footer_bg',
				'border_color',
			),

			'buttons' => array(
				'primary_button_bg',
				'primary_button_border',
				'primary_button_textcolor',
				'primary_button_textshadow',
				'alt_button_bg',
				'alt_button_border',
				'alt_button_textcolor',
				'alt_button_textshadow',
			),
		);
	}


	/**
	 * Returns an array of mod ids
	 *
	 * @return array mod ids
	 */
	public static function get_mods()
	{
		$mod_sections = self::get_sections_with_mods();

		return array_merge(
			$mod_sections['title_tagline'],
			$mod_sections['general_settings'],
			$mod_sections['text_colors'],
			$mod_sections['background_colors'],
			$mod_sections['buttons']
		);
	}


	/**
	 * Removes mods of the selected 'remove_section_mods' value
	 *
	 * @return void
	 */
	public static function remove_section_mods()
	{
		$section = get_theme_mod('remove_section_mods');

		if (false === $section) {
			return;
		}

		$mod_sections = self::get_sections_with_mods();

		$mods = $mod_sections[$section];

		if (false === is_array($mods)) {
			return;
		}

		foreach($mods as $mod) {
			remove_theme_mod($mod);
		}

		remove_theme_mod('remove_section_mods');
	}


	public static function remove_all_mods()
	{
		if ( 1 != get_theme_mod('remove_all_mods') ) {
			return;
		}

		$mods = self::get_mods();

		foreach($mods as $mod) {
			remove_theme_mod($mod);
		}

		remove_theme_mod('remove_all_mods');
	}


	/**
	 * Converts hex into rgb
	 *
	 * @param string $hex the hex value to convert
	 *
	 * @return string the rgb value
	 */
	public static function hex2rgb($hex)
	{
	   $hex = str_replace("#", "", $hex);

	   if (strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }

	   $rgb = array($r, $g, $b);

	   return implode(",", $rgb); // returns the rgb values separated by commas
	}
}