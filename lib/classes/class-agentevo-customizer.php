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
	 */
	public static function register( $wp_customize )
	{
		# Sections
		# ==========================================================================

		$wp_customize->add_section('agentevo_header', array(
				'title'     => __( 'Header Styling', 'agentevo' ),
				'priority'  => 35
		) );

		$wp_customize->add_section('agentevo_nav', array(
				'title'     => __( 'Main Navigation Styling', 'agentevo' ),
				'priority'  => 36
		) );

		$wp_customize->add_section('agentevo_subnav', array(
				'title'     => __( 'Subnavigation Styling', 'agentevo' ),
				'priority'  => 37
		) );

		$wp_customize->add_section('agentevo_body', array(
				'title'     => __( 'Body Styling', 'agentevo' ),
				'priority'  => 38
		) );

		$wp_customize->add_section('agentevo_footer_widgets', array(
				'title'     => __( 'Footer Widgets Styling', 'agentevo' ),
				'priority'  => 39
		) );

		$wp_customize->add_section('agentevo_homepage', array(
				'title'     => __( 'Home Page Styling', 'agentevo' ),
				'priority'  => 40
		) );

		$wp_customize->add_section('agentevo_headlines', array(
				'title'     => __( 'Headlines', 'agentevo' ),
				'priority'  => 41
		) );

		$wp_customize->add_section('agentevo_primary_button', array(
				'title'     => __( 'Primary Button Styling', 'agentevo' ),
				'priority'  => 42
		) );

		$wp_customize->add_section('agentevo_alt_button', array(
				'title'     => __( 'Alternate Button Styling', 'agentevo' ),
				'priority'  => 43
		) );

		$wp_customize->add_section('agentevo_misc', array(
				'title'     => __( 'Miscellaneous', 'agentevo' ),
				'priority'  => 44
		) );

		$wp_customize->add_section('agentevo_options', array(
				'title'     => __( 'Options', 'agentevo' ),
				'priority'  => 45
		) );


		# Settings & Controls
		# ==========================================================================


		/* Site Title and Tagline
		 --------------------------------------------------*/

		$wp_customize->add_setting('logo_display_type', array(
			'default'   => 'text'
		) );

		$wp_customize->add_setting('site_title_color');
		$wp_customize->add_setting('site_description_color');

		$wp_customize->add_setting('logo_image', array(
			'default' => get_stylesheet_directory_uri() . '/images/logo-default.png'
		) );

		$wp_customize->add_setting('logo_image_width', array(
			'default' => '362'
		) );

		// Logo display type
		$wp_customize->add_control( 'logo_display_type', array(
			'label'      => __( 'Logo Display Type', 'agentevo' ),
			'section'    => 'title_tagline',
			'settings'   => 'logo_display_type',
			'priority'   => 1,
			'type'       => 'radio',
			'choices'    => array(
				'image'  => 'Custom Image',
				'text'   => 'Use site title and tagline as logo'
			)
		) );

		// Site Title Color
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_color', array(
			'label'      => __( 'Site Title Color', 'agentevo' ),
			'section'    => 'title_tagline',
			'settings'   => 'site_title_color',
			'priority'   => 2
		) ) );

		// Site Description Color
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_description_color', array(
			'label'      => __( 'Site Description Color', 'agentevo' ),
			'section'    => 'title_tagline',
			'settings'   => 'site_description_color',
			'priority'   => 3
		) ) );

		// Logo Image
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image', array(
			'label'      => __( 'Custom Logo - Must be 480x70 or smaller', 'agentevo' ),
			'section'    => 'title_tagline',
			'settings'   => 'logo_image',
			'priority'   => 4
		) ) );

		// Logo Image Width
		$wp_customize->add_control('logo_image_width', array(
			'label'    => __('Logo Image Width in pixels (necessary for centering on small screens)', 'agentevo' ),
			'section'  => 'title_tagline',
			'settings' => 'logo_image_width',
			'priority' => 5
		) );


		/* Header
		 --------------------------------------------------*/

		$wp_customize->add_setting('header_background');

		// Header Background
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
				'label'      => __( 'Header Background', 'agentevo' ),
				'section'    => 'agentevo_header',
				'settings'   => 'header_background',
				'priority'   => 1
		) ) );


		/* Body
		 --------------------------------------------------*/

		$wp_customize->add_setting('body_background');
		$wp_customize->add_setting('body_textcolor');
		$wp_customize->add_setting('link_textcolor');

		 // Body Background
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background', array(
				'label'      => __( 'Body Background', 'agentevo' ),
				'section'    => 'agentevo_body',
				'settings'   => 'body_background',
				'priority'   => 1
		) ) );

		// Text
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_textcolor', array(
				'label'      => __( 'Text Color', 'agentevo' ),
				'section'    => 'agentevo_body',
				'settings'   => 'body_textcolor',
				'priority'   => 2
		) ) );

		// Links
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_textcolor', array(
				'label'      => __( 'Link Color', 'agentevo' ),
				'section'    => 'agentevo_body',
				'settings'   => 'link_textcolor',
				'priority'   => 3
		) ) );


		/* Homepage
		 --------------------------------------------------*/





		/* Footer Widgets
		 --------------------------------------------------*/

		$wp_customize->add_setting('fw_background');
		$wp_customize->add_setting('fw_border_top');
		$wp_customize->add_setting('fw_border_bottom');
		$wp_customize->add_setting('fw_textcolor');
		$wp_customize->add_setting('fw_header_borders');

		// Footer Widgets Text Color
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fw_textcolor', array(
				'label'      => __( 'Footer Widgets Text Color', 'agentevo' ),
				'section'    => 'agentevo_footer_widgets',
				'settings'   => 'fw_textcolor',
				'priority'   => 2
		) ) );

		// Footer Widgets Background
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fw_background', array(
				'label'      => __( 'Footer Widgets Background', 'agentevo' ),
				'section'    => 'agentevo_footer_widgets',
				'settings'   => 'fw_background',
				'priority'   => 1
		) ) );

		// Footer Widgets Border Top
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fw_border_top', array(
				'label'      => __( 'Footer Widgets Border Top', 'agentevo' ),
				'section'    => 'agentevo_footer_widgets',
				'settings'   => 'fw_border_top',
				'priority'   => 4
		) ) );

		// Footer Widgets Border Bottom
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fw_border_bottom', array(
				'label'      => __( 'Footer Widgets Border Bottom', 'agentevo' ),
				'section'    => 'agentevo_footer_widgets',
				'settings'   => 'fw_border_bottom',
				'priority'   => 5
		) ) );

		// Footer widgets header borders
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fw_header_borders', array(
				'label'      => __( 'Footer Widget Headlines Bottom Border', 'agentevo' ),
				'section'    => 'agentevo_footer_widgets',
				'settings'   => 'fw_header_borders',
				'priority'   => 3
		) ) );


		/* Primary Nav
		 --------------------------------------------------*/

		$wp_customize->add_setting('nav_textcolor');
		$wp_customize->add_setting('nav_textshadow');
		$wp_customize->add_setting('nav_gradient_1');
		$wp_customize->add_setting('nav_gradient_2');
		$wp_customize->add_setting('nav_border_top');
		$wp_customize->add_setting('nav_border_bottom');

		// Nav Gradient 1
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_gradient_1', array(
				'label'      => __( 'Main Nav Gradient Color 1', 'agentevo' ),
				'section'    => 'agentevo_nav',
				'settings'   => 'nav_gradient_1',
				'priority'   => 1
		) ) );

		// Nav Gradient 2
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_gradient_2', array(
				'label'      => __( 'Main Nav Gradient Color 2', 'agentevo' ),
				'section'    => 'agentevo_nav',
				'settings'   => 'nav_gradient_2',
				'priority'   => 2
		) ) );

		// Nav textcolor
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_textcolor', array(
				'label'      => __( 'Main Nav Text Color', 'agentevo' ),
				'section'    => 'agentevo_nav',
				'settings'   => 'nav_textcolor',
				'priority'   => 3
		) ) );

		// Nav textshadow
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_textshadow', array(
				'label'      => __( 'Main Nav Text Shadow', 'agentevo' ),
				'section'    => 'agentevo_nav',
				'settings'   => 'nav_textshadow',
				'priority'   => 4
		) ) );

		// Nav border top
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_border_top', array(
				'label'      => __( 'Main Nav Border Top', 'agentevo' ),
				'section'    => 'agentevo_nav',
				'settings'   => 'nav_border_top',
				'priority'   => 5
		) ) );

		// Nav border bottom
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_border_bottom', array(
				'label'      => __( 'Main Nav Border Bottom', 'agentevo' ),
				'section'    => 'agentevo_nav',
				'settings'   => 'nav_border_bottom',
				'priority'   => 6
		) ) );


		/* Subnav
		 --------------------------------------------------*/

		$wp_customize->add_setting('subnav_textcolor');
		$wp_customize->add_setting('subnav_textshadow');
		$wp_customize->add_setting('subnav_gradient_1');
		$wp_customize->add_setting('subnav_gradient_2');
		$wp_customize->add_setting('subnav_border_top');
		$wp_customize->add_setting('subnav_border_bottom');

		// Subnav Gradient 1
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'subnav_gradient_1', array(
				'label'      => __( 'Subnav Gradient Color 1', 'agentevo' ),
				'section'    => 'agentevo_subnav',
				'settings'   => 'subnav_gradient_1',
				'priority'   => 1
		) ) );

		// Subnav Gradient 2
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'subnav_gradient_2', array(
				'label'      => __( 'Subnav Gradient Color 2', 'agentevo' ),
				'section'    => 'agentevo_subnav',
				'settings'   => 'subnav_gradient_2',
				'priority'   => 2
		) ) );

		// Subnav text color
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'subnav_textcolor', array(
				'label'      => __( 'Subnav Text Color', 'agentevo' ),
				'section'    => 'agentevo_subnav',
				'settings'   => 'subnav_textcolor',
				'priority'   => 3
		) ) );

		// Subnav textshadow
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'subnav_textshadow', array(
				'label'      => __( 'Subav Text Shadow', 'agentevo' ),
				'section'    => 'agentevo_subnav',
				'settings'   => 'subnav_textshadow',
				'priority'   => 4
		) ) );

		// Subnav border top
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'subnav_border_top', array(
				'label'      => __( 'Subnav Border Top', 'agentevo' ),
				'section'    => 'agentevo_subnav',
				'settings'   => 'subnav_border_top',
				'priority'   => 5
		) ) );

		// Subnav border bottom
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'subnav_border_bottom', array(
				'label'      => __( 'Subnav Border Bottom', 'agentevo' ),
				'section'    => 'agentevo_subnav',
				'settings'   => 'subnav_border_bottom',
				'priority'   => 6
		) ) );


		/* Headlines (text)
		 --------------------------------------------------*/

		$wp_customize->add_setting('primary_header_border');
		$wp_customize->add_setting('alt_header_border');
		$wp_customize->add_setting('headings_textcolor');

		// Headings
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headings_textcolor', array(
				'label'      => __( 'Headings Text Color', 'agentevo' ),
				'section'    => 'agentevo_headlines',
				'settings'   => 'headings_textcolor',
				'priority'   => 1
		) ) );

		// Primary header border
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_header_border', array(
				'label'      => __( 'Primary Headlines Border Left', 'agentevo' ),
				'section'    => 'agentevo_headlines',
				'settings'   => 'primary_header_border',
				'priority'   => 2
		) ) );

		// Alternate header border
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_header_border', array(
				'label'      => __( 'Alternate Headlines Border Left', 'agentevo' ),
				'section'    => 'agentevo_headlines',
				'settings'   => 'alt_header_border',
				'priority'   => 3
		) ) );


		/* Primary Button Styling
		 --------------------------------------------------*/

		$wp_customize->add_setting('primary_button_gradient_1');
		$wp_customize->add_setting('primary_button_gradient_2');
		$wp_customize->add_setting('primary_button_textcolor');
		$wp_customize->add_setting('primary_button_textshadow');
		$wp_customize->add_setting('primary_button_border');
		$wp_customize->add_setting('primary_button_boxshadow');


		// Primary Button Gradient 1
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_button_gradient_1', array(
				'label'      => __( 'Primary Buttons Gradient 1', 'agentevo' ),
				'section'    => 'agentevo_primary_button',
				'settings'   => 'primary_button_gradient_1',
				'priority'   => 1
		) ) );

		// Primary Button Gradient 2
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_button_gradient_2', array(
				'label'      => __( 'Primary Buttons Gradient 2', 'agentevo' ),
				'section'    => 'agentevo_primary_button',
				'settings'   => 'primary_button_gradient_2',
				'priority'   => 2
		) ) );

		// Primary Button Border
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_button_border', array(
				'label'      => __( 'Primary Button Border', 'agentevo' ),
				'section'    => 'agentevo_primary_button',
				'settings'   => 'primary_button_border',
				'priority'   => 3
		) ) );

		// Primary Button Box Shadow
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_button_boxshadow', array(
				'label'      => __( 'Primary Button Box Shadow', 'agentevo' ),
				'section'    => 'agentevo_primary_button',
				'settings'   => 'primary_button_boxshadow',
				'priority'   => 4
		) ) );

		// Primary Button Color
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_button_textcolor', array(
				'label'      => __( 'Primary Button Text Color', 'agentevo' ),
				'section'    => 'agentevo_primary_button',
				'settings'   => 'primary_button_textcolor',
				'priority'   => 5
		) ) );

		// Primary Button Text Shadow
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_button_textshadow', array(
				'label'      => __( 'Primary Button Text Shadow', 'agentevo' ),
				'section'    => 'agentevo_primary_button',
				'settings'   => 'primary_button_textshadow',
				'priority'   => 6
		) ) );


		/* Alternate Button Styling
		 --------------------------------------------------*/

		$wp_customize->add_setting('alt_button_gradient_1');
		$wp_customize->add_setting('alt_button_gradient_2');
		$wp_customize->add_setting('alt_button_textcolor');
		$wp_customize->add_setting('alt_button_textshadow');
		$wp_customize->add_setting('alt_button_border');
		$wp_customize->add_setting('alt_button_boxshadow');


		// Alternate Button Gradient 1
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_button_gradient_1', array(
				'label'      => __( 'Alternate Buttons Gradient 1', 'agentevo' ),
				'section'    => 'agentevo_alt_button',
				'settings'   => 'alt_button_gradient_1',
				'priority'   => 1
		) ) );

		// Alternate Button Gradient 2
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_button_gradient_2', array(
				'label'      => __( 'Alternate Buttons Gradient 2', 'agentevo' ),
				'section'    => 'agentevo_alt_button',
				'settings'   => 'alt_button_gradient_2',
				'priority'   => 2
		) ) );

		// Alternate Button Border
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_button_border', array(
				'label'      => __( 'Alternate Button Border', 'agentevo' ),
				'section'    => 'agentevo_alt_button',
				'settings'   => 'alt_button_border',
				'priority'   => 3
		) ) );

		// Alternate Button Box Shadow
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_button_boxshadow', array(
				'label'      => __( 'Alternate Button Box Shadow', 'agentevo' ),
				'section'    => 'agentevo_alt_button',
				'settings'   => 'alt_button_boxshadow',
				'priority'   => 4
		) ) );

		// Alternate Button Text Color
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_button_textcolor', array(
				'label'      => __( 'Alternate Button Text Color', 'agentevo' ),
				'section'    => 'agentevo_alt_button',
				'settings'   => 'alt_button_textcolor',
				'priority'   => 5
		) ) );

		// Alternate Button Text Shadow
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_button_textshadow', array(
				'label'      => __( 'Alternate Button Text Shadow', 'agentevo' ),
				'section'    => 'agentevo_alt_button',
				'settings'   => 'alt_button_textshadow',
				'priority'   => 6
		) ) );


		/* Miscellaneous
		 --------------------------------------------------*/

		$wp_customize->add_setting('post_meta_bg');
		$wp_customize->add_setting('sidebar_widget_bg');
		$wp_customize->add_setting('input_bg');
		$wp_customize->add_setting('input_border');

		// Post Meta Background
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_meta_bg', array(
				'label'      => __( 'Post Meta Background', 'agentevo' ),
				'section'    => 'agentevo_misc',
				'settings'   => 'post_meta_bg',
				'priority'   => 1
		) ) );

		// Sidebar Widget Background
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_widget_bg', array(
				'label'      => __( 'Sidebar Widget Background', 'agentevo' ),
				'section'    => 'agentevo_misc',
				'settings'   => 'sidebar_widget_bg',
				'priority'   => 2
		) ) );

		// Input & Textarea Backgrounds
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_bg', array(
				'label'      => __( 'Input and Textarea Backgrounds', 'agentevo' ),
				'section'    => 'agentevo_misc',
				'settings'   => 'input_bg',
				'priority'   => 3
		) ) );

		// Input and Textarea Borders
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_border', array(
				'label'      => __( 'Input and Textarea Borders', 'agentevo' ),
				'section'    => 'agentevo_misc',
				'settings'   => 'input_border',
				'priority'   => 4
		) ) );


		/* Options
		 --------------------------------------------------*/

		$wp_customize->add_setting('remove_all_mods');
		$wp_customize->add_setting('remove_section_mods');

		// Remove All Mods
		$wp_customize->add_control( 'remove_all_mods', array(
			'label'      => __( 'Remove All Customizations', 'agentevo' ),
			'section'    => 'agentevo_options',
			'settings'   => 'remove_all_mods',
			'type'       => 'checkbox'
		) );

		// Remove mods by section
		$wp_customize->add_control( 'remove_section_mods', array(
			'label'      => __( 'Remove Customizations By Section. Select one, press save, and refresh the page to see the changes.', 'agentevo' ),
			'section'    => 'agentevo_options',
			'settings'   => 'remove_section_mods',
			'type'       => 'radio',
			'choices'    => array(
				'title_tagline'   => 'Site Title & Tagline',
				'header'          => 'Header Styling',
				'body'            => 'Body',
				'homepage'        => 'Home Page',
				'footer_widgets'  => 'Footer Widgets',
				'primary_nav'     => 'Main Navigation Styling',
				'subnav'          => 'Subnavigation Styling',
				'headlines'       => 'Headlines',
				'primary_button'  => 'Primary Button',
				'alt_button'      => 'Alternate Button',
				'misc'            => 'Miscellaneous'
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
		?>
		<!-- begin Customizer CSS -->
		<style type="text/css">
			<?php
			// Custom logo
			self::generate_css('.header-image #title-area a', 'background-image', 'logo_image', 'url(', ')' );

			// Header background color
			self::generate_css('body .site-header', 'background', 'header_background');

			// Site title color
			self::generate_css('.site-header #title a', 'color', 'site_title_color');

			// Logo Image Width
			self::generate_css('.header-image #title a', 'width', 'logo_image_width', '', 'px');

			// Site description color
			self::generate_css('.site-header #description', 'color', 'site_description_color');

			// Body background color
			self::generate_css('body', 'background-color', 'body_background');

			// Main nav background
			self::generate_gradient_css('body nav.primary', 'nav_gradient_1', 'nav_gradient_2');

			// Main nav border top
			self::generate_css('nav.primary', 'border-top', 'nav_border_top', '1px solid ');

			// Main nav border bottom
			self::generate_css('nav.primary', 'border-bottom', 'nav_border_bottom', '1px solid ');

			// Main nav submenu background (inherits nav_gradient_2 color)
			self::generate_css('
				nav.primary li li a,
				nav.primary li li a:hover,
				nav.primary li li a:link,
				nav.primary li li a:visited',
				'background', 'nav_gradient_2'
			);

			// Main nav submenu border color ( inherits nav_gradient_1 color )
			self::generate_css('
				nav.primary li li a,
				nav.primary li li a:hover,
				nav.primary li li a:link,
				nav.primary li li a:visited',
				'border-color', 'nav_gradient_1'
			);

			// Subnav background
			self::generate_gradient_css('body nav.secondary', 'subnav_gradient_1', 'subnav_gradient_2');

			// Subnav border top
			self::generate_css('nav.secondary', 'border-top', 'subnav_border_top', '1px solid ');

			// Subnav border bottom
			self::generate_css('nav.secondary', 'border-bottom', 'subnav_border_bottom', '1px solid ');

			// Subnav submenu background color ( inherits subnav_gradient_2 color )
			self::generate_css('
				nav.secondary li li a,
				nav.secondary li li a:hover,
				nav.secondary li li a:link,
				nav.secondary li li a:visited',
				'background', 'subnav_gradient_2'
			);

			// Subnav submenu border color ( inherits subnav_gradient_1 color )
			self::generate_css('
				nav.secondary li li a,
				nav.secondary li li a:hover,
				nav.secondary li li a:link,
				nav.secondary li li a:visited',
				'border-color', 'subnav_gradient_1'
			);

			// Primary Button Classes
			$primary_button_classes = '
				div.gform_footer input.button,
				input[type="submit"],
				input[type="button"],
				.enews #subbutton,
				.reply a,
				.reply a:visited,
				.searchsubmit,
				#submit,
				.btn-primary
			';

			// Primary Button Background
			self::generate_gradient_css($primary_button_classes, 'primary_button_gradient_1', 'primary_button_gradient_2', '#5da5ef', '#165da7');

			// Primary button border
			self::generate_css($primary_button_classes, 'border', 'primary_button_border', '1px solid ');

			// Primary button box shadow
			self::generate_css($primary_button_classes, 'box-shadow', 'primary_button_boxshadow', 'inset 0 0 2px ');

			// Primary button textcolor
			self::generate_css($primary_button_classes, 'color', 'primary_button_textcolor');

			// Primary button text shadow
			self::generate_css($primary_button_classes, 'text-shadow', 'primary_button_textshadow', '-1px -1px ');

			$alt_button_classes = '
				input.btn-alt,
				.btn-alt,
				.property-search input[type="submit"],
				input[type="submit"].btn-alt
			';

			// Alt Button Background
			self::generate_gradient_css($alt_button_classes, 'alt_button_gradient_1', 'alt_button_gradient_2', '#76ca86', '#2b7e3b');

			// Alt button textcolor
			self::generate_css($alt_button_classes, 'color', 'alt_button_textcolor');

			// Alt Button textshadow
			self::generate_css($alt_button_classes, 'text-shadow', 'alt_button_textshadow', '-1px -1px ');

			// Alt button border
			self::generate_css($alt_button_classes, 'border', 'alt_button_border', '1px solid ');

			// Alt Button box shadow
			self::generate_css($alt_button_classes, 'box-shadow', 'alt_button_boxshadow', 'inset 0 0 2px ');

			// Home Properties Section Background
			self::generate_css('.home .properties', 'background', 'properties_background');

			// Home Bottom Border Top
			self::generate_css('.home-bottom', 'border-top', 'hb_border_top', '1px solid ');

			// Footer Widgets Background
			self::generate_css('body #footer-widgets', 'background', 'fw_background');

			// Footer Widgets Border Top
			self::generate_css('body #footer-widgets', 'border-top', 'fw_border_top', '1px solid ');

			// Footer Widgets Border Bottom
			self::generate_css('body #footer-widgets', 'border-bottom', 'fw_border_bottom', '1px solid ');

			// Body text color
			self::generate_css('body,p,select,textarea,input', 'color', 'body_textcolor');

			// Headings text color
			self::generate_css('h1,h2,h2 a,h2 a:visited,h3,h4,h5,h6', 'color', 'headings_textcolor' );

			// Main nav text color
			self::generate_css('
				nav.primary li a,
				nav.primary li a:hover,
				nav.primary li a:active,
				nav.primary .current_page_item a,
				nav.primary .current-cat a,
				nav.primary .current-menu-item a',
				'color', 'nav_textcolor'
			);

			// Main nav text shadow
			self::generate_css('nav.primary li a', 'text-shadow', 'nav_textshadow', '1px 1px ');

			// Subnav text color
			self::generate_css('
				body nav.secondary li a,
				nav.secondary li a:hover,
				nav.secondary li a:active,
				nav.secondary .current_page_item a,
				nav.secondary .current-cat a,
				nav.secondary .current-menu-item a',
				'color', 'subnav_textcolor'
			);

			// Subnav text shadow
			self::generate_css('nav.secondary li a', 'text-shadow', 'subnav_textshadow', '1px 1px ');

			// Link textcolor
			self::generate_css('a, a:visited', 'color', 'link_textcolor' );

			// Home properties text color
			self::generate_css('
				.home .properties,
				.home .properties p,
				.home .properties span,
				.home .properties div,
				.home .properties .widgettitle',
				'color', 'properties_textcolor', '', ' !important'
			);

			// Footer widgets text color
			self::generate_css('
				#footer-widgets,
				#footer-widgets p,
				#footer-widgets .widgettitle,
				#footer-widgets a',
				'color', 'fw_textcolor', '', ' !important'
			);

			// Primary header border
			self::generate_css('
				.properties .widgettitle,
				.archive .post h2 a,
				.page-template-page_blog-php .post h2 a,
				h1.entry-title',
				'border-color', 'primary_header_border'
			);

			// Alternate header border
			self::generate_css('
				.home-bottom-left .widgettitle,
				.home-bottom-right .widgettitle,
				.sidebar .widgettitle',
				'border-color', 'alt_header_border'
			);

			self::generate_css('#footer-widgets .widgettitle', 'border-color', 'fw_header_borders');

			$input_classes = '
			textarea,
			input[type="text"],
			input[type="password"],
			input[type="datetime"],
			input[type="datetime-local"],
			input[type="date"],
			input[type="month"],
			input[type="time"],
			input[type="week"],
			input[type="number"],
			input[type="email"],
			input[type="url"],
			input[type="search"],
			input[type="tel"],
			input[type="color"]
			';

			// Post Meta BG
			self::generate_css('.post-meta', 'background-color', 'post_meta_bg');

			// Sidebar Widget BG
			self::generate_css('.sidebar .widget', 'background-color', 'sidebar_widget_bg');

			// Input/Textarea BG
			self::generate_css($input_classes, 'background-color', 'input_bg');

			// Input/Textarea Borders
			self::generate_css($input_classes, 'border', 'input_border', '1px solid ');

			// Remove nav top and bottom borders if there is a custom gradient
			// They won't match and adding a setting for them might cause
			// unnecessary complication
			self::hide_elements('nav.primary:before,nav.primary:after', 'nav_gradient_1');
			self::hide_elements('nav.secondary:before,nav.secondary:after', 'subnav_gradient_1');
			?>
		</style>
		<!-- end Customizer CSS -->
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
	 * @since Nouveau 1.0
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


	public static function generate_gradient_css($selector, $color1, $color2, $default1 = '', $default2 = '')
	{
		$mod = $color1;
		$color1 = get_theme_mod($color1);
		$color2 = get_theme_mod($color2);

		if ( empty($color1) && empty($color2) ) {
			return;
		}

		if ( $mod == 'primary_button_gradient_1' || $mod == 'alt_button_gradient_1' ) {
			if ( empty($color1) ) {
				$color1 = $default1;
			}

			if ( empty($color2) ) {
				$color2 = $default2;
			}
		}

		echo $selector, '{
			background: ', $color1, '; /* Old browsers */
			background: -moz-linear-gradient(top, ', $color1, ' 0%, ', $color2, ' 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,', $color1, '), color-stop(100%,', $color2, ')); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, ', $color1, ' 0%,', $color2, ' 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, ', $color1, ' 0%,', $color2, ' 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top, ', $color1, ' 0%,', $color2, ' 100%); /* IE10+ */
			background: linear-gradient(to bottom, ', $color1, ' 0%,', $color2, ' 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="', $color1, '", endColorstr="', $color2, '",GradientType=0 ); /* IE6-9 */
		}';
	}


	public static function hide_elements($selector, $mod)
	{
		$mod = get_theme_mod($mod);

		if ( empty($mod) ) {
			return;
		}

		echo $selector, '{
			display: none;
		}';
	}


	/**
	 * Output css conditionally
	 *
	 * @param string $css the css to output
	 * @param string $mod the mod to check against
	 * @param bool $active if true outputs the css when the mod is active
	 */
	public static function css($css, $mod, $active = 1)
	{

		$mod = get_theme_mod($mod);

		if ( empty($mod) && $active == 1 ) {
			return;
		}

		echo $css;
	}


	public static function get_mods()
	{
		return array(
			'logo_display_type',
			'logo_image',
			'logo_image_width',
			'body_background',
			'header_background',

			'nav_gradient_1',
			'nav_gradient_2',
			'nav_textcolor',
			'nav_textshadow',
			'nav_border_top',
			'nav_border_bottom',

			'subnav_gradient_1',
			'subnav_gradient_2',
			'subnav_textshadow',
			'subnav_textcolor',
			'subnav_border_top',
			'subnav_border_bottom',

			'primary_button_gradient_1',
			'primary_button_gradient_2',
			'primary_button_textcolor',
			'primary_button_textshadow',
			'primary_button_border',
			'primary_button_boxshadow',

			'alt_button_gradient_1',
			'alt_button_gradient_2',
			'alt_button_textcolor',
			'alt_button_textshadow',
			'alt_button_border',
			'alt_button_boxshadow',

			// home

			'site_title_color',
			'site_description_color',

			'body_textcolor',
			'headings_textcolor',
			'link_textcolor',
			'properties_textcolor',
			'hb_border_top',

			'fw_textcolor',
			'fw_header_borders',
			'fw_border_top',
			'fw_background',
			'fw_border_bottom',
			'fw_textcolor',

			'post_meta_bg',
			'sidebar_widget_bg',
			'input_bg',
			'input_border',

			'primary_header_border',
			'alt_header_border'
		);
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
	 * Returns an array of mods for the specified section
	 *
	 * Available sections:
	 * title_tagline
	 * header
	 * body
	 * homepage
	 * footer_widgets
	 * primary_nav
	 * subnav
	 * headlines
	 * primary_button
	 * alt_button
	 * misc
	 *
	 * @param string $section the section to return
	 */
	public static function get_section_mods( $section )
	{
		switch ( $section ) {

			case 'title_tagline':
				$output = array(
					'logo_display_type',
					'site_title_color',
					'site_description_color',
					'logo_image',
					'logo_image_width',
				);
				break;

			case 'header':
				$output = array(
					'header_background'
				);
				break;

			case 'body':
				$output = array(
					'body_background',
					'body_textcolor',
					'link_textcolor'
				);
				break;

			case 'homepage':
				$output = array(

				);
				break;

			case 'footer_widgets':
				$output = array(
					'fw_background',
					'fw_border_top',
					'fw_border_bottom',
					'fw_textcolor',
					'fw_header_borders'
				);
				break;

			case 'primary_nav':
				$output = array(
					'nav_textcolor',
					'nav_textshadow',
					'nav_gradient_1',
					'nav_gradient_2',
					'nav_border_top',
					'nav_border_bottom'
				);
				break;

			case 'subnav':
				$output = array(
					'subnav_textcolor',
					'subnav_textshadow',
					'subnav_gradient_1',
					'subnav_gradient_2',
					'subnav_border_top',
					'subnav_border_bottom'
				);
				break;

			case 'headlines':
				$output = array(
					'primary_header_border',
					'alt_header_border',
					'headings_textcolor'
				);
				break;

			case 'primary_button':
				$output = array(
					'primary_button_gradient_1',
					'primary_button_gradient_2',
					'primary_button_textcolor',
					'primary_button_textshadow',
					'primary_button_border',
					'primary_button_boxshadow'
				);
				break;

			case 'alt_button':
				$output = array(
					'alt_button_gradient_1',
					'alt_button_gradient_2',
					'alt_button_textcolor',
					'alt_button_textshadow',
					'alt_button_border',
					'alt_button_boxshadow'
				);
				break;

			case 'misc':
				$output = array(
					'post_meta_bg',
					'sidebar_widget_bg',
					'input_bg',
					'input_border'
				);

			default:
				$output = false;

		}

		return $output;
	}


	/**
	 * Removes mods of the selected 'remove_section_mods' value
	 */
	public static function remove_section_mods()
	{
		$section = get_theme_mod('remove_section_mods');

		if (false === $section) {
			return;
		}

		$mods = self::get_section_mods($section);

		if (false === is_array($mods)) {
			return;
		}

		foreach($mods as $mod) {
			remove_theme_mod($mod);
		}

		remove_theme_mod('remove_section_mods');
	}
}