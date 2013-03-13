<?php
/*
	Template Name: Shortcodes
*/

remove_filter('the_content', 'wpautop');

add_filter( 'body_class', 'shortcodes_body_class' );
/**
 * Adds a css class to the body element
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
function shortcodes_body_class( $classes ) {
	$classes[] = 'page-shortcodes';
	return $classes;
}

add_action('wp_enqueue_scripts', 'shortcode_template_scripts');
function shortcode_template_scripts()
{
	wp_enqueue_style('prettify', CHILD_URL . '/css/prettify.css');
}

genesis();