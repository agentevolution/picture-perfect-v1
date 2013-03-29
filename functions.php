<?php
/**
 * Functions
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Setup
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}

define('AE_CHILD_THEME_NAME', 'Picture Perfect');
define('AE_CHILD_THEME_SLUG', 'picture-perfect');

require_once 'lib/classes/class-agentevo-helpers.php';
require_once 'lib/classes/class-agentevo-customizer.php';
require_once 'lib/classes/class-agentevo-nav-walker.php';
require_once 'lib/functions/admin.php';
require_once 'lib/functions/frontend.php';


/**
 * Outputs the footer markup
 *
 * @return void
 */
function picture_perfect_footer()
{
    ?>
    <div class="one-half first footer-left">
        <?php echo do_shortcode(genesis_get_option('footer-left', 'agentevo-footer-settings')); ?>
    </div>
    <div class="one-half footer-right">
        <?php echo do_shortcode(genesis_get_option('footer-right', 'agentevo-footer-settings')); ?>
        <?php echo agentevo_footer_copy(); ?>
    </div>
    <?php

    $disclaimer = genesis_get_option('disclaimer', 'agentevo-footer-settings');

    if (false === empty($disclaimer)) {
        echo '
        <div class="footer-disclaimer">',
            do_shortcode(wpautop($disclaimer)),
        '</div>';
    }
}


# Include functions that should run in development only
# Else serve css/style.css
if ( isset($_SERVER['SERVER_NAME']) && 'localhost' == $_SERVER['SERVER_NAME'] ) {
	require_once 'lib/classes/class-agentevo-development-setup.php';
} else {
	add_filter('stylesheet_uri', 'picture_perfect_stylesheet_uri', 10, 2);
}


/**
 * Returns the path to the style.css file
 *
 * @return string path to the style.css file
 */
function picture_perfect_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri)
{
	return $stylesheet_dir_uri . '/css/style.css';
}


if ( ! get_option('picture_perfect_theme_activation') ) {

	wp_remote_post(
		'http://themes.agentevolution.com/child-theme-stats',
		array(
		 'body' => array(
		 	 'theme' => 'picture_perfect',
		 	 'url'   => $_SERVER['SERVER_NAME'],
		 	)
		)
	);

	add_option('picture_perfect_theme_activation', 'yes');
}