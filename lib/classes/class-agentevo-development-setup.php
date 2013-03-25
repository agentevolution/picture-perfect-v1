<?php
/**
 * Functions for assisting development
 *
 * PHP version 5
 *
 * @package PicturePerfect/Development
 * @author  Agent Evolution <support@agentevolution.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPL
 * @link    http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}

class Agentevo_Development_Setup
{
    public function __construct()
    {
        add_action('genesis_setup', array($this, 'dev_setup'));
        add_action('wp_footer', array($this, 'init_less_dev_mode'));
        add_filter( 'show_admin_bar', '__return_false' );
    }


    /**
     * Attaches functions to hooks and filters
     *
     * @return void
     */
    public function dev_setup()
    {
        add_action('wp_head',            array($this, 'output_less_css_link'), 1);
        add_filter('stylesheet_uri',     array($this, 'stylesheet_uri'));
        add_action('wp_enqueue_scripts', array($this, 'load_less_js'));
    }


    /**
     * Outputs the link for styles.less
     *
     * @return void
     */
    public function output_less_css_link()
    {
        echo '<link rel="stylesheet/less" id="less" href="'.CHILD_URL.'/less/styles.less" type="text/css" media="all" />';
    }


    /**
     * Returns an empty string for the stylesheet uri
     *
     * The purpose is to disable loading of style.css because
     * we are using LESS instead of CSS
     *
     * @return string
     */
    public function stylesheet_uri()
    {
        return '';
    }


    /**
     * Enqueues less.js
     *
     * @return void
     */
    public function load_less_js()
    {
        wp_enqueue_script('less', CHILD_URL . '/js/less-1.3.3.min.js');
    }

    /**
     * Forces LESS to show changes without page refresh
     */
    function init_less_dev_mode() {
        ?>
        <script type="text/javascript">
            less.env = "development";
            less.watch();
        </script>
        <?php
    }
}   

new Agentevo_Development_Setup;