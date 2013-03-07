<?php
/*
	Template Name: Shortcodes
*/

remove_filter('the_content', 'wpautop');

add_action('wp_enqueue_scripts', 'shortcode_template_scripts');
function shortcode_template_scripts()
{
	wp_enqueue_style('prettify', CHILD_URL . '/css/prettify.css');
}

genesis();