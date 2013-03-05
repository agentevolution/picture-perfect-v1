<?php
/**
 * Functions for front end customization
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Frontend
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
    die('Sorry, you are not allowed to access this file directly.');
}


add_action('genesis_setup', 'picture_perfect_frontend_setup', 15);
/**
 * Front End Setup
 *
 * Do not write functions inside the frontend setup function.
 * Write your functions below it.
 *
 * Attach the functions you wrote to the appropriate hooks and filters
 * inside the front end setup function.
 *
 * @return void
 */
function picture_perfect_frontend_setup()
{
    # Enable html5 doctype and elements
    add_theme_support('genesis-html5');

    # Add the html5 shim to the document head
    add_action('wp_head', 'picture_perfect_add_ie_html5_shim');

    # Enqueue Scripts
    add_action('wp_enqueue_scripts', 'picture_perfect_load_scripts');

    # Responsive Meta Tag
    add_action('genesis_meta', 'picture_perfect_viewport_meta_tag');

    # Add google fonts link to head
    add_action('genesis_meta', 'picture_perfect_add_google_fonts', 5);

    # Enable shortcode in widgets
    add_filter('widget_text', 'do_shortcode');

    # Footer
    remove_action('genesis_footer', 'genesis_do_footer');
    add_action('genesis_footer', 'picture_perfect_footer');

    # Structural wrap support
    add_theme_support(
        'genesis-structural-wraps',
        array(
         'header',
         'nav',
         'subnav',
         'inner',
         'footer-widgets',
         'footer',
        )
    );

    # Header image body class
    remove_filter('body_class', 'genesis_header_body_classes');
    add_filter('body_class', 'picture_perfect_custom_logo_body_class');

    # Favicon
    add_filter('genesis_pre_load_favicon', 'picture_perfect_favicon_filter');

    # IE8 and down CSS
    add_action('wp_head', 'picture_perfect_load_ie8_css');

    # Post Date shortcode filter
    add_filter('genesis_post_date_shortcode', 'agentevo_post_date_shortcode_filter', 10, 2);

    # Post time shortcode filter
    add_filter('genesis_post_time_shortcode', 'agentevo_post_time_shortcode_filter', 10, 2);

    # Post author shortcode filter
    add_filter('genesis_post_author_posts_link_shortcode', 'agentevo_post_author_posts_link_shortcode_filter', 10, 2);

    # Genesis post info filter
    add_filter('genesis_post_info', 'agentevo_post_info_filter');

    # Genesis post comment shortcode filter
    add_filter('genesis_post_comments_shortcode', 'agentevo_post_comments_shortcode_filter', 10, 2);

    # Genesis post tags shortcode filter
    add_filter('genesis_post_tags_shortcode', 'agentevo_post_tags_shortcode_filter', 10, 2);

    # Filter wp_nav_menu args and add description walker
    add_filter('wp_nav_menu_args', 'agentevo_wp_nav_menu_args', 10, 1);

    # Genesis post categories shortcode filter
    add_filter('genesis_post_categories_shortcode', 'agentevo_post_categories_shortcode_filter', 10, 2);
}


/**
 * Adds header-image to body classes if the site title is an image
 *
 * @param array $classes the current body classes
 *
 * @return array modified body classes
 */
function picture_perfect_custom_logo_body_class($classes)
{
    if ('image' === get_theme_mod('logo_display_type')) {
        $classes[] = 'header-image';
    }

    return $classes;
}


/**
 * Links custom favicon to document head
 *
 * @return string the path to the favicon.ico
 */
function picture_perfect_favicon_filter()
{
    return get_stylesheet_directory_uri().'/images/favicon.ico';
}


/**
 * Loads a small bit of CSS into the document head for IE8 and down
 *
 * @return void
 */
function picture_perfect_load_ie8_css()
{
    ?>
    <!--[if lt IE 9]>
        <style>

        </style>
    <![endif]-->
    <?php
}


/**
 * Outputs the Viewport Meta Tag for Mobile Browsers
 *
 * @return void
 */
function picture_perfect_viewport_meta_tag()
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}


/**
 * Outputs the html5 shim to head of the document
 *
 * This allows html5 elements to by styled via CSS in IE 8 and below
 *
 * @return void
 */
function picture_perfect_add_ie_html5_shim()
{
echo
'<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->';
}


/**
 * Enqueues javascripts
 *
 * @return void
 */
function picture_perfect_load_scripts()
{

}


/**
 * Adds the link to Google Web Fonts
 * Always use this instead of @import.
 *
 * @return void
 */
function picture_perfect_add_google_fonts()
{
    echo "<link href='http://fonts.googleapis.com/css?family=Lato|PT+Sans' rel='stylesheet' type='text/css'>";

}


/**
 * Outputs the footer markup
 *
 * @return void
 */
function picture_perfect_footer()
{
    ?>
    <div class="one-half first footer-left">
        <?php
        echo
        do_shortcode(
            wpautop(genesis_get_option('footer-left', 'agentevo-footer-settings'))
        );
        ?>
    </div>
    <div class="one-half footer-right">
        <p>
            Powered by the
            <a href="http://themes.agentevolution.com/shop/<?php echo AE_CHILD_THEME_SLUG; ?>">
                <?php echo AE_CHILD_THEME_NAME; ?>
            </a>
            theme on the
            <a href="http://agentevo.com/genesis">
                Genesis Framework
            </a>
        </p>
        <?php
        echo
        do_shortcode(
            wpautop(genesis_get_option('footer-right', 'agentevo-footer-settings'))
        );
        ?>
    </div>
    <div id="footer-disclaimer">
        <?php
        echo
        do_shortcode(
            wpautop(genesis_get_option('disclaimer', 'agentevo-footer-settings'))
        );
        ?>
    </div>
    <?php
}


/**
 * Adds agentevo nav walker to wp_nav_menu output
 *
 * The Agentevo_Nav_Walker enables descriptions in menu items
 * as well as certain icons to enabled through special icon classes
 *
 * @see lib/classes/Agentevo_Nav_Walker.php
 *
 * @param array $args arguments for building the nav menu
 */
function agentevo_wp_nav_menu_args($args)
{
    $args['walker'] = new Agentevo_Nav_Walker;
    return $args;
}


/**
 * Adds markup for font awesome icon to post date shortcode
 *
 * @return string markup for the post date shortcode
 */
function agentevo_post_date_shortcode_filter($output, $atts)
{
    $display = ( 'relative' == $atts['format'] ) ? genesis_human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'genesis' ) : get_the_time( $atts['format'] );

    return sprintf( '<span class="date published time" title="%5$s"><i class="icon-calendar"></i> %1$s%3$s%4$s%2$s</span> ', $atts['before'], $atts['after'], $atts['label'], $display, get_the_time( 'c' ) );
}


/**
 * Adds markup for font awesome icon to post time shortcode
 *
 * @return string markup for the post time shortcode
 */
function agentevo_post_time_shortcode_filter($output, $atts)
{
    return sprintf( '<span class="published time" title="%5$s"><i class="icon-time"></i> %1$s%3$s%4$s%2$s</span> ', $atts['before'], $atts['after'], $atts['label'], get_the_time( $atts['format'] ), get_the_time( 'Y-m-d\TH:i:sO' ) );
}


/**
 * Adds markup for font awesome icon to post author
 *
 * @return string markup for the post author shortcode
 */
function agentevo_post_author_posts_link_shortcode_filter($output, $atts)
{
    $author = sprintf( '<a href="%s" class="fn n" title="%s" rel="author">%s</a>', get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_author(), get_the_author() );
    $output = sprintf( '<span class="author vcard"><i class="icon-user"></i> %2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after'] );
    return $output;
}


/**
 * Customizes genesis post info
 *
 * @return string markup for genesis_post_info
 */
function agentevo_post_info_filter()
{
    return '[post_date]' . '[post_author_posts_link] [post_comments] [post_edit]';
}


/**
 * Adds the font awesome comment icon to post info
 *
 * @param string $output html output
 * @param array $atts attributes passed in through shortcode
 *
 * @return string markup for the post content shortcode
 */
function agentevo_post_comments_shortcode_filter($output, $atts)
{
    ob_start();
    comments_number( $atts['zero'], $atts['one'], $atts['more'] );
    $comments = ob_get_clean();
    $comments = sprintf( '<a href="%s">%s</a>', get_comments_link(), $comments );
    $output = sprintf( '<span class="post-comments"><i class="icon-comment"></i> %2$s%1$s%3$s</span>', $comments, $atts['before'], $atts['after'] );
    return $output;
}


/**
 * Adds markup for font awesome icon to post tags shortcode
 *
 * @param string $output html output
 * @param array $atts attributes passed in through shortcode
 *
 * @return string markup for the post tags shortcode
 */
function agentevo_post_tags_shortcode_filter($output, $atts)
{
    $tags = get_the_tag_list( $atts['before'], trim( $atts['sep'] ) . ' ', $atts['after'] );

    $output = sprintf( '<span class="tags"><i class="icon-tags"></i> %s</span> ', $tags );

    return $output;
}


/**
 * Adds markup for font awesome icon to post categories shortcode
 *
 * @param string $output html output
 * @param array $atts attributes passed in through shortcode
 *
 * @return string markup for the post categories shortcode
 */
function agentevo_post_categories_shortcode_filter($output, $atts)
{
    $cats = get_the_category_list( trim( $atts['sep'] ) . ' ' );

    $output = sprintf( '<span class="categories"><i class="icon-folder-open"></i> %2$s%1$s%3$s</span> ', $cats, $atts['before'], $atts['after'] );

    return $output;
}