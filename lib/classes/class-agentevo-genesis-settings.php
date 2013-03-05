<?php
/**
 * AgentEvo Genesis Settings
 *
 * PHP version 5
 *
 * @package PicturePerfect/Admin
 * @author  Agent Evolution <support@agentevolution.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPL
 * @link    http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}

class Agentevo_Genesis_Settings
{
    /**
     * Attaches functions to actions and filters
     *
     * @return void
     */
    public function __construct()
    {
        add_action('genesis_settings_sanitizer_init',     array($this, 'sanitization_filters'), 1);
        add_filter('genesis_theme_settings_defaults',     array($this, 'social_accounts'));
        add_action('genesis_theme_settings_metaboxes',    array($this, 'metaboxes'));
    }


    /**
     * Adds social fields to Genesis default settings
     *
     * @param array $defaults genesis defaults
     *
     * @return array modified defaults
     */
    public function social_accounts($defaults)
    {
        $defaults['twitter_handle'] = '';
        $defaults['facebook_url']   = '';
        $defaults['pinterest_url']  = '';
        $defaults['linkedin_url']   = '';
        $defaults['youtube_url']    = '';
        $defaults['googleplus_url'] = '';
        $defaults['agent_address']  = '';
        $defaults['agent_phone']    = '';
        return $defaults;
    }


    /**
     * Sanitizes input fields
     *
     * @return void
     */
    public function sanitization_filters()
    {
        genesis_add_option_filter(
            'no_html',
            GENESIS_SETTINGS_FIELD,
            array(
             'twitter_handle',
             'agent_address',
             'agent_phone',
             'agent_email',
            )
        );

        genesis_add_option_filter(
            'url',
            GENESIS_SETTINGS_FIELD,
            array(
             'facebook_url',
             'pinterest_url',
             'linkedin_url',
             'youtube_url',
             'googleplus_url',
            )
        );
    }


    /**
     * Registers theme setting metaboxes
     *
     * @param string $_genesis_theme_settings_pagehook
     *
     * @return void
     */
    public function metaboxes($_genesis_theme_settings_pagehook)
    {
        add_meta_box('agentevo-social-settings', 'Social Links and Contact Info', array($this, 'social_settings_box'), $_genesis_theme_settings_pagehook, 'main', 'high');
    }


    /**
     * Creates the Social Metabox
     *
     * @return void
     */
    public function social_settings_box()
    {
        ?>
        <p>Twitter Handle: ( No @symbol, just the actual handle, @nik_nik would just be nik_nik )<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[twitter_handle]" value="<?php echo esc_attr(genesis_get_option('twitter_handle')); ?>" size="50" />
        </p>

        <p>Facebook URL:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[facebook_url]" value="<?php echo esc_attr(genesis_get_option('facebook_url')); ?>" size="50" />
        </p>

        <p>GooglePlus URL:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[googleplus_url]" value="<?php echo esc_attr(genesis_get_option('googleplus_url')); ?>" size="50" />
        </p>

        <p>Pinterest URL:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[pinterest_url]" value="<?php echo esc_attr(genesis_get_option('pinterest_url')); ?>" size="50" />
        </p>

        <p>LinkedIn URL:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[linkedin_url]" value="<?php echo esc_attr(genesis_get_option('linkedin_url')); ?>" size="50" />
        </p>

        <p>YouTube Channel URL:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[youtube_url]" value="<?php echo esc_attr(genesis_get_option('youtube_url')); ?>" size="50" />
        </p>

        <p>Address:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[agent_address]" value="<?php echo esc_attr(genesis_get_option('agent_address')); ?>" size="50" />
        </p>

        <p>Phone:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[agent_phone]" value="<?php echo esc_attr(genesis_get_option('agent_phone')); ?>" size="50" />
        </p>

        <p>Email:<br />
            <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[agent_email]" value="<?php echo esc_attr(genesis_get_option('agent_email')); ?>" size="50" />
        </p>
        <?php
    }
}

new Agentevo_Genesis_Settings;