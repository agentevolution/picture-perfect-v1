<?php

remove_action('genesis_after_content', 'genesis_footer_widget_areas', 999);

add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');
add_action('genesis_meta', 'picture_perfect_home_genesis_meta');
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @return void
 */
function picture_perfect_home_genesis_meta()
{
	$sidebar_widget_areas = array(
		'home-right',
	);

	if (false === any_picture_perfect_sidebar_is_active($sidebar_widget_areas)) {
		add_filter('body_class', 'picture_perfect_blog_home_page_body_class');
		return;
	}

	# Custom body class
	add_filter('body_class', 'picture_perfect_custom_home_page_body_class');

	# Remove the loop and add a custom loop
	remove_action('genesis_loop', 'genesis_do_loop');
	add_action('genesis_loop', 'picture_perfect_home_loop_helper');
}


/**
 * Adds a custom body class on the home page
 *
 * @param array $classes the current body classes
 *
 * @return array modified classes
 */
function picture_perfect_blog_home_page_body_class($classes)
{
   $classes[] = 'blog-home-page';
   return $classes;
}


/**
 * Adds a custom body class on the home page
 *
 * @param array $classes the current body classes
 *
 * @return array modified classes
 */
function picture_perfect_custom_home_page_body_class($classes)
{
   $classes[] = 'custom-home-page';
   return $classes;
}


/**
 * Display widget content for homepage sections
 */
function picture_perfect_home_loop_helper()
{
	echo '<div class="home-right">';

		picture_perfect_site_title_description_markup();

		if (is_active_sidebar('home-right')) {
			dynamic_sidebar('home-right');
		}

	echo '</div>';
}

/**
 * Returns true if any of the picture_perfect sidebars are active
 *
 * @param array $sidebar_widget_areas registered sidebars for use on home page
 *
 * @return bool
 */
function any_picture_perfect_sidebar_is_active($sidebar_widget_areas)
{
	foreach($sidebar_widget_areas as $sidebar) {
		if ( is_active_sidebar($sidebar) ) {
			return true;
		}
	}

	return false;
}

genesis();