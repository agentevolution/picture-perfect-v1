<?php
/**
 * Functions for customizing the admin
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Admin
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}


add_action('genesis_setup', 'picture_perfect_admin_setup', 15);
/**
 * Admin Setup
 *
 * Do not write functions inside the admin setup function.
 * Write your functions below it.
 *
 * Attach the functions you wrote to the appropriate hooks and filters
 * inside the admin setup function.
 *
 * @return void
 */
function picture_perfect_admin_setup()
{
    require CHILD_DIR . '/lib/classes/class-agentevo-footer-settings.php';
    require CHILD_DIR . '/lib/classes/class-agentevo-genesis-settings.php';
    require 'shortcodes.php';

    # Image Sizes
    add_image_size('blog_featured', 715, 240, true);
    add_image_size('sidebar_featured', 352, 125, true);
    add_image_size('properties', 560, 400, true);

    # Unregister unused sidebar
    unregister_sidebar('sidebar-alt');
    unregister_sidebar('header-right');

    # Remove Unused Page Layouts
    genesis_unregister_layout('content-sidebar-sidebar');
    genesis_unregister_layout('sidebar-sidebar-content');
    genesis_unregister_layout('sidebar-content-sidebar');

    # Unregister genesis nav menus
    remove_theme_support( 'genesis-menus' );
 
    # Register primary nav
    add_theme_support('genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ));

    # Add support for 3 footer widgets
    add_theme_support('genesis-footer-widgets', 3);

    # Don't update theme
    add_filter('http_request_args', 'picture_perfect_dont_update_theme', 5, 2);

    # Customize link under the appearance tab
    add_action('admin_menu', 'picture_perfect_customize_menu_link');

    # Add documentation link to menu bar
    add_action(
        'wp_before_admin_bar_render',
        'picture_perfect_add_documentation_link_to_admin_bar'
    );

    # Register sidebars
    picture_perfect_register_sidebars();

    # Footer settings admin page
    add_action('genesis_admin_menu', 'picture_perfect_add_footer_settings');

    # Icon class menu page metabox
    add_action('admin_init', 'picture_perfect_icon_class_menu_page_metabox');
}


/**
 * Prevents theme update prompt
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @param array  $r   request arguments
 * @param string $url request url
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @return array request arguments
 */
function picture_perfect_dont_update_theme($r, $url)
{
    if (0 !== strpos($url, 'http://api.wordpress.org/themes/update-check')) {
        // Not a theme update request. Bail immediately.
        return $r;
    }

    $themes = unserialize($r['body']['themes']);
    unset($themes[get_option('template')]);
    unset($themes[get_option('stylesheet')]);
    $r['body']['themes'] = serialize($themes);

    return $r;
}


/**
 * Adds a documentation link to the admin bar
 *
 * @return void
 */
function picture_perfect_add_documentation_link_to_admin_bar()
{
    global $wp_admin_bar;

    $wp_admin_bar->add_menu(
        array(
         'parent' => false,
         'id'     => 'theme-setup-guide',
         'title'  => __('Theme Setup Guide'),
         'href'   => 'http://themes.agentevolution.com/guides/picture-perfect-theme-setup-guide',
         'meta'   => array('target' => '_blank')
        )
    );
}


/**
 * Register sidebars
 *
 * @return void
 */
function picture_perfect_register_sidebars()
{
    genesis_register_sidebar(
        array(
         'id'          => 'home-right',
         'name'        => 'Home Right',
         'description' => 'This is the Home Right section. This is a great place for a "custom menu" widget.',
        )
    );
}


/**
 * Adds the customize link to the admin menu under the Appearance tab
 *
 * @return void
 */
function picture_perfect_customize_menu_link()
{
    add_theme_page('Customize', 'Customize', 'edit_theme_options', 'customize.php');
}


/**
 * Adds the Footer page under appearance in the admin
 *
 * @return void
 */
function picture_perfect_add_footer_settings()
{
    global $_agentevo_footer_settings;
    $_agentevo_footer_settings = new Agentevo_Footer_Settings;
}


/**
 * Adds a metabox to the menu administration page
 *
 * @return void
 */
function picture_perfect_icon_class_menu_page_metabox()
{
    add_meta_box( 'icon-class-menu', __('Icon Classes'), 'picture_perfect_icon_class_menu_page_metabox_content', 'nav-menus', 'side', 'default' );
}


/**
 * Shows a list of available icon css classes
 */
function picture_perfect_icon_class_menu_page_metabox_content()
{
    ?>
    <p>
        To display an icon graphic next to a nav menu item,
        add one of the following classes to the menu item's
        "CSS Classes" field.
    </p>
    <p>
        If you do not see the "CSS Classes" field, then you need
        to enable them by toggling the screen options tab on the top right
        corner of the screen and checking the "CSS Classes" box.
    </p>
    <h4>Icon Classes</h4>
    <ul>
        <li>icon-search</li>
        <li>icon-home</li>
        <li>icon-pencil</li>
        <li>icon-envelope</li>
    </ul>
    <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">See all icon classes</a>
    <br /><br />
    <?php
}