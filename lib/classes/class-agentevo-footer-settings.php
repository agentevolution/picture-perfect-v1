<?php
/**
 * Footer Settings
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

/**
 * Creates metaboxes for the footer left and footer right content
 */
class Agentevo_Footer_Settings extends Genesis_Admin_Boxes
{
    /**
     * Create an admin menu item and settings page.
     */
    public function __construct()
    {
        # Specify a unique page ID.
        $page_id = 'agentevo-footer-content';

        # Set it as a child to 'appearance', and define the menu and page titles
        $menu_ops = array(
                     'submenu' => array(
                                   'parent_slug' => 'themes.php',
                                   'page_title'  => 'Footer Content',
                                   'menu_title'  => 'Footer',
                                  )
                    );

        # Set up page options. These are optional, so only uncomment if you want to change the defaults
        $page_ops = array(
                     // 'screen_icon'       => 'options-general',
                     // 'save_button_text'  => 'Save Settings',
                     // 'reset_button_text' => 'Reset Settings',
                     // 'save_notice_text'  => 'Settings saved.',
                     // 'reset_notice_text' => 'Settings reset.',
                    );

        # Give it a unique settings field.
        # You'll access them from genesis_get_option( 'option_name', 'agentevo-footer-settings' );
        $settings_field = 'agentevo-footer-settings';

        # Set the default values
        $default_settings = array(
                             'footer-left'  => '[social_icons] <p class="copyright">Copyright &copy; ' . date('Y') . ' All Rights Reserved</p>',
                             'footer-right' => '',
                             'disclaimer'   => '',
                            );

        # Create the Admin Page
        $this->create($page_id, $menu_ops, $page_ops, $settings_field, $default_settings);

        # Initialize the Sanitization Filter
        add_action('genesis_settings_sanitizer_init', array($this, 'sanitization_filters'));
    }


    /**
     * Set up Sanitization Filters
     *
     * @see genesis/lib/classes/sanitization.php for all available filters.
     * @return void
     */
    public function sanitization_filters()
    {
        genesis_add_option_filter(
            'safe_html',
            $this->settings_field,
            array(
             'footer-left',
             'footer-right',
             'disclaimer',
            )
        );
    }


    /**
     * Set up Help Tab
     *
     * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
     *
     * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
     * @return void
     */
    public function help()
    {
        $screen = get_current_screen();

        $screen->add_help_tab(
            array(
             'id'      => 'agentevo-footer-help',
             'title'   => 'Turn Key Footer',
             'content' => '<p>Use the editors below to customize the content of the footer left, footer right, and disclaimer.</p>',
            )
        );
    }


    /**
     * Register metaboxes on the Footer Settings page
     *
     * @return void
     */
    public function metaboxes()
    {
        add_meta_box('footer_metabox', 'Footer', array($this, 'footer_metabox'), $this->pagehook, 'main', 'high');
    }


    /**
     * Footer Metabox
     *
     * @return void
     */
    public function footer_metabox()
    {
        echo '<p><strong>Footer Left:</strong></p>';
        wp_editor($this->get_field_value('footer-left'), $this->get_field_id('footer-left'), array('textarea_rows' => 5));

        echo '<p><strong>Footer Right:</strong></p>';
        wp_editor($this->get_field_value('footer-right'), $this->get_field_id('footer-right'), array('textarea_rows' => 5));

        echo '<p><strong>Disclaimer:</strong></p>';
        wp_editor($this->get_field_value('disclaimer'), $this->get_field_id('disclaimer'), array('textarea_rows' => 5));
    }

}