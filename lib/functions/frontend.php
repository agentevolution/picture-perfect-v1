<?php
/**
 * Functions for front end customization
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Frontend
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
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

    # Reposition the primary navigation bar
    remove_action('genesis_after_header', 'genesis_do_nav');
    add_action('genesis_before_header', 'genesis_do_nav');

    # Remove secondary navigation
    remove_theme_support('genesis-menus');
    add_theme_support(
        'genesis-menus',
        array('primary' => __('Primary Navigation Menu', 'genesis'))
    );

    # Remove the header
    remove_action('genesis_header', 'genesis_do_header');
    remove_action('genesis_header', 'genesis_header_markup_open', 5);
    remove_action('genesis_header', 'genesis_header_markup_close', 15);

    # Responsive Meta Tag
    add_action('genesis_meta', 'picture_perfect_viewport_meta_tag');

    # Add google fonts link to head
    add_action('genesis_meta', 'picture_perfect_add_google_fonts', 5);

    # Enqueue theme.js
    add_action('wp_enqueue_scripts', 'picture_perfect_javascripts');

    # Enable shortcode in widgets
    add_filter('widget_text', 'do_shortcode');

    # Reposition the footer widgets
    remove_action('genesis_before_footer', 'genesis_footer_widget_areas');
    add_action('genesis_after_content', 'genesis_footer_widget_areas', 999);

    # Footer
    remove_action('genesis_footer', 'genesis_do_footer');
    add_action('genesis_footer', 'picture_perfect_footer');

    # Structural wrap support
    add_theme_support(
        'genesis-structural-wraps',
        array(
         // 'header',
         'nav',
         // 'subnav',
         // 'inner',
         // 'footer-widgets',
         'footer',
        )
    );

    # Set default layout to sidebar-content
    genesis_set_default_layout('sidebar-content');

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

    # Genesis search form filter
    add_filter('genesis_search_form', 'agentevo_custom_search_form', 10, 1);

    # Genesis post tags shortcode filter
    add_filter('genesis_post_tags_shortcode', 'agentevo_post_tags_shortcode_filter', 10, 2);

    # Filter wp_nav_menu args and add description walker
    add_filter('wp_nav_menu_args', 'agentevo_wp_nav_menu_args', 10, 1);

    # Genesis post categories shortcode filter
    add_filter('genesis_post_categories_shortcode', 'agentevo_post_categories_shortcode_filter', 10, 2);

    # Add site title and description markup before the sidebar
    add_action('genesis_before_sidebar_widget_area', 'picture_perfect_site_title_description_markup');

    # Add the hidden site title and description markup.
    # This markup will appear at the top of the content on small screen sizes
    # and on full width content pages. This is due to the site title and description
    # showing up before the sidebar. This ensures that a site title and description
    # is visible even when there is no sidebar or the sidebar is pushed down
    # below the content.
    add_action('genesis_before_content', 'picture_perfect_site_title_description_markup', 1);

    # Outputs the backstretch js
    add_action('wp_footer', 'picture_perfect_backstretch_js', 9999);
}


/**
 * Echos the site title and description markup
 *
 * @return void
 */
function picture_perfect_site_title_description_markup()
{
    $markup = '<div class="site-title-description-container">';

    if ( is_home() || is_front_page() ) {
        $markup .= "\n" . '<h1 class="site-title"><a href="' . site_url() . '">' . get_bloginfo('name') . '</a></h1>';
    } else {
        $markup .= "\n" . '<p class="site-title"><a href="' . site_url() . '">' . get_bloginfo('name') . '</a></p>';
    }

    $markup .= "\n" . '<p class="site-description">' . get_bloginfo('description') . '</p>';
    $markup .= "\n" . '</div>';
    echo $markup;
}


/**
 * Adds title-type-text to body classes if the site title is an image
 *
 * @param array $classes the current body classes
 *
 * @return array modified body classes
 */
function picture_perfect_custom_logo_body_class($classes)
{
    if ( 'text' == get_theme_mod('logo_display_type') ) {
        $classes[] = 'title-type-text';        
    } else {
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
    return get_stylesheet_directory_uri() . '/images/favicon.ico';
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
} // FIXME


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
 * Adds the link to Google Web Fonts
 * Always use this instead of @import.
 *
 * @return void
 */
function picture_perfect_add_google_fonts()
{
    echo "<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>";
}


/**
 * Enqueues theme.js
 *
 * @return void
 */
function picture_perfect_javascripts()
{
    wp_enqueue_script('backstretch', CHILD_URL . '/js/jquery.backstretch.min.js', array('jquery'), false, true);
    wp_enqueue_script('picture_perfect', CHILD_URL . '/js/theme.js', array('jquery'), false, true);
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
        do_shortcode(genesis_get_option('footer-left', 'agentevo-footer-settings'));
        ?>
    </div>
    <div class="one-half footer-right">
        <p class="credits">
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
    <?php

    $disclaimer = genesis_get_option('disclaimer', 'agentevo-footer-settings');

    if (false === empty($disclaimer)) {
        echo '
        <div class="footer-disclaimer">',
            do_shortcode(wpautop($disclaimer)),
        '</div>';
    }
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
 * Customizes the search form
 *
 * @param string $form the form markup
 */
function agentevo_custom_search_form($form)
{
    $search_text = get_search_query() ? esc_attr( apply_filters( 'the_search_query', get_search_query() ) ) : apply_filters( 'genesis_search_text', esc_attr__( 'Search this website', 'genesis' ) . '&#x02026;' );

    $button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

    $onfocus = " onfocus=\"if (this.value == '$search_text') {this.value = '';}\"";
    $onblur  = " onblur=\"if (this.value == '') {this.value = '$search_text';}\"";
    
    /** Empty label, by default. Filterable. */
    $label = apply_filters( 'genesis_search_form_label', '' );

    $form = '
        <form method="get" class="searchform search-form" action="' . home_url() . '/" >
            ' . $label . '
            <i class="icon-search"></i>
            <input type="text" value="' . esc_attr( $search_text ) . '" name="s" class="s search-input"' . $onfocus . $onblur . ' />
            <input type="submit" class="searchsubmit search-submit" value="' . esc_attr( $button_text ) . '" />
        </form>
    ';

    return $form;
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


/**
 * Echos the javascript for the backstretch image to the footer
 *
 * @return void
 */
function picture_perfect_backstretch_js()
{
    global $post;

    $thumb_id = get_post_thumbnail_id($post->ID);
    $thumb_url = wp_get_attachment_url($thumb_id);

    // use default if no post thumnbail, not a single post, and not a blog post
    if (false === $thumb_url || false === is_single() && false === is_page()) {
        $thumb_url = get_theme_mod('default_background_image');
    }

    if (empty($thumb_url)) {
        $thumb_url = CHILD_URL . '/images/PicturePerfect.jpg';
    }

    ?>
    <script>jQuery.backstretch("<?php echo $thumb_url; ?>");</script>
    <?php
}