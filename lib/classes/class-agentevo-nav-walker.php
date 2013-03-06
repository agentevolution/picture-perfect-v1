<?php
/**
 * Agentevo Nav Walker
 *
 * PHP version 5
 *
 * @package  PicturePerfect/Helpers
 * @author   Agent Evolution <support@agentevolution.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://themes.agentevolution.com
 */

if (defined('ABSPATH') === false) {
	die("Sorry, you are not allowed to access this page directly.");
}

/**
 * Enables the description and an icon to be displayed in a WordPress menu
 */
class Agentevo_Nav_Walker extends Walker_Nav_Menu
{
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{

		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		if ( $item->description ) {
			$classes[] = 'has-description';
		} else {
			$classes[] = 'no-description';
		}

		$has_icons = $this->contains_icon_enabled_class($classes);

		if ( $has_icons ) {
			$classes[] = 'has-icon';
		} else {
			$classes[] = 'no-icon';
		}

		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		# Remove icon classes from $class_names so they are not added to the li element.
		# Avoid duplicate icons
		$class_names = str_replace('icon-', 'has-icon-', $class_names);

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		// use the title as title attribute if none specified
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ' title="' . $item->title . '"';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;

		$item_output .= '<a'. $attributes .'>';

		// add the icon markup if a "special class" was given in the admin
		$item_output .= $this->add_icon_markup($classes);

		// wrap description and title in div if there is a description and a title
		if ( $has_icons && $item->description ) {
			$item_output .= '<div class="link-text">';
		}

		if ( $has_icons ) {
			$item_output .= '<span class="link-title">';
		}

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		if ( $has_icons ) {
			$item_output .= '</span>';
		}

		// append the description if available
		if ( $item->description ) {
			$item_output .= '<span class="description">' . esc_attr( $item->description ) . '</span>';
		}

		if ( $has_icons && $item->description ) {
			$item_output .= '</div>';
		}

		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	/**
	 * Prepends an <i> tag to the list item if it has a class containing the string
	 * 'icon-'
	 *
	 * This allows users to add a font awesome icon to a menu item.
	 *
	 * @param array $classes the classes assigned to the item
	 *
	 * @return string|void <i> tag with the icon class if a match is found
	 */
	public function add_icon_markup($classes)
	{
		foreach ($classes as $class) {
			
			if (false !== strpos($class, 'icon-')) {
				return '<i class="' . $class . '"></i>';
			}
		}
	}


	/**
	 * Returns true if the array contains an icon enabled class
	 *
	 * An icon enabled class is simply any class that contains the string 'icon-'
	 *
	 * @param array $classes css classes of the menu item
	 *
	 * @return bool
	 */
	public function contains_icon_enabled_class($classes)
	{
		$classes = (array) $classes;

		foreach ($classes as $class) {
			if (false !== strpos($class, 'icon-')) {
				return true;
			}
		}

		return false;
	}
}