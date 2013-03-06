<?php
/**
 * Shortcodes
 *
 * PHP version 5
 *
 * @package PicturePerfect/Frontend
 * @author  Agent Evolution <support@agentevolution.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPL
 * @link    http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}


add_shortcode('agent_phone', 'agent_phone_shortcode');
/**
 * Adds agent phone shortcode
 *
 * @return string
 */
function agent_phone_shortcode()
{
    $phone = genesis_get_option('agent_phone');
    return sprintf('<span class="agent-phone">%s</span>', $phone);

}


add_shortcode('agent_address', 'agent_address_shortcode');
/**
 * Adds agent address shortcode
 *
 * @return string
 */
function agent_address_shortcode()
{
    $address = genesis_get_option('agent_address');
    return sprintf('<p class="agent-address">%s</p>', $address);

}


add_shortcode('button', 'agentevo_button_shortcode');
/**
 * Adds the button shortcode
 *
 * @param array  $atts    attributes passed from shortcode
 * @param string $content anchor text
 *
 * @return string
 */
function agentevo_button_shortcode($atts, $content=null)
{
    extract(
        shortcode_atts(
            array(
             'size'  => 'small',
             'color' => 'nil',
             'block' => 0,
             'url'   => '#',
            ),
            $atts
        )
    );

    $classes = 'btn btn-' . $size . ' btn-' . $color;

    if ($block === true) {
        $classes .= ' btn-block';
    }

    return '<a class="' . $classes . '" href="' . $url . '">' . $content . '</a>';

}


add_shortcode('column', 'agentevo_column_shortcode');
/**
 * Adds the column shortcode
 *
 * @param array  $atts    attributes passed from shortcode
 * @param string $content column content
 *
 * @return string
 */
function agentevo_column_shortcode($atts, $content=null)
{
    extract(
        shortcode_atts(
            array(
             'size'  => '',
             'first' => 0,
            ),
            $atts
        )
    );

    if ($first === true) {
        $classes = $size . ' first';
    } else {
        $classes = $size;
    }

    return '<div class="' . $classes . '">' . do_shortcode($content) . '</div>';

}


add_shortcode('social_icons', 'agentevo_social_icons');
/**
 * Returns links with the icon class of their type wrapped in a div
 *
 * @return string
 */
function agentevo_social_icons()
{
    global $_ae;
    $links = $_ae->get_social_links();
    $icons = '';

    foreach ($links as $type => $url) {

        if ('email' === $type) {
            $url = 'mailto:' . $url;
            $type = 'envelope';
        }

        if ('' !== $url) {
            $icons .= '<a class="icon-' . $type . '" href="' . $url . '"></a>';
        }
    }

    return '<div class="agent-social-icons clearfix">' . $icons . '</div>';

}