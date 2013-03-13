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

# Include functions that should run in development only
if ( isset($_SERVER['SERVER_NAME']) && 'localhost' == $_SERVER['SERVER_NAME'] ) {
	require_once 'lib/classes/class-agentevo-development-setup.php';
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