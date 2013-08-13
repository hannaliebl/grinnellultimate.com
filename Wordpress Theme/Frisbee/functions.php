<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

// Add player class and associated functions
locate_template( array( 'functions' . DIRECTORY_SEPARATOR . 'players.php' ), true );

// Register the jQuery plugin I made for the front page slideshow

wp_register_script( 'jQuerySlider',
                    get_template_directory_uri() . "/js/jQuerySlider.js",
                    array("jquery")); 
                    
// Custom HTML5 Comment Markup
function mytheme_comment($comment, $args, $depth) {
	 $GLOBALS['comment'] = $comment; ?>
	 <li>
		 <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			 <header class="comment-author vcard">
			 	<time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),	get_comment_time()) ?></a></time><br />
					<?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
					<?php printf(__('<cite class="fn">%s</cite> <span class="says">wrote:</span>'), get_comment_author_link()) ?>
					<?php edit_comment_link(__('(Edit)'),'	','') ?>
			 </header>
			 <?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.') ?></em>
					<br />
			 <?php endif; ?>

			 <?php comment_text() ?>

			 <nav>
				 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			 </nav>
		 </article>
		<!-- </li> is added by wordpress automatically -->
<?php
}

automatic_feed_links();

// Widgetized Sidebar HTML5 Markup
add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
  register_sidebar(array(
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

// Change excerpt length
function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 ); 

// Make "continue reading" link to the post
function new_excerpt_more($more) {
       global $post;
	return '...<a href="'. get_permalink($post->ID) . '">Continue reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Custom Functions for CSS/Javascript Versioning
$GLOBALS["TEMPLATE_URL"] = get_bloginfo('template_url')."/";
$GLOBALS["TEMPLATE_RELATIVE_URL"] = wp_make_link_relative($GLOBALS["TEMPLATE_URL"]);

// Add ?v=[last modified time] to style sheets
function versioned_stylesheet($relative_url, $add_attributes=""){
	echo '<link rel="stylesheet" href="'.versioned_resource($relative_url).'" '.$add_attributes.'>'."\n";
}

// Add ?v=[last modified time] to javascripts
function versioned_javascript($relative_url, $add_attributes=""){
	echo '<script src="'.versioned_resource($relative_url).'" '.$add_attributes.'></script>'."\n";
}

// Add ?v=[last modified time] to a file url
function versioned_resource($relative_url){
	$file = $_SERVER["DOCUMENT_ROOT"].$relative_url;
	$file_version = "";

	if(file_exists($file)) {
		$file_version = "?v=".filemtime($file);
	}

	return $relative_url.$file_version;
}

// Enable categories for attachments so that they can be queried for the 
// front-page slideshow
add_action('admin_init', 'reg_tax');
function reg_tax() {
   register_taxonomy_for_object_type('category', 'attachment');
   add_post_type_support('attachment', 'category');
}


// Add utility function for use with usort
function getFn($sort) {
  return function($a, $b) use($sort) {
    if($a->$sort > $b->$sort) return 1;
    if($a->$sort < $b->$sort) return -1;
    return 0;
  };
}


/* Add footer menu and main menu support as well as a custom nav walker
 * for the footer menu
 * */

function registerMenus () {
  register_nav_menus( array(
    'nav-main' => __( 'Top Navigation' ), 
    'nav-footer' => __( 'Footer Navigation' ) 
  ));
}
add_action('init','registerMenus');

// Add custom menu walker for the footer menu
class footer_walker_nav extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"footer-sub-menu\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    /* passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
    */
		$output .= $indent . '<li '/*class="' . $class_names . '" */.'>';

		$attributes	= ! empty( $item->attr_title )  ? ' title="'	. esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )		  ? ' target="' . esc_attr( $item->target		 ) .'"' : '';
		$attributes .= ! empty( $item->xfn )			  ? ' rel="'		. esc_attr( $item->xfn				) .'"' : '';
		$attributes .= ! empty( $item->url )			  ? ' href="'	 . esc_attr( $item->url				) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// The function called in the template to output the footer nav menu
function wp_footer_nav_menu( $args = array() ) {
	static $menu_id_slugs = array();

	$defaults = array( 'menu' => '', 'container' => 'nav', 'container_class' => '', 'container_id' => '', 'menu_class' => 'footer', 'menu_id' => '',
	'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul class="%2$s">%3$s</ul>',
	'depth' => 0, 'walker' => '', 'theme_location' => '' );

	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_nav_menu_args', $args );
	$args = (object) $args;

	// Get the nav menu based on the requested menu
	$menu = wp_get_nav_menu_object( $args->menu );

	// Get the nav menu based on the theme_location
	if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
		$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

	// get the first menu that has items if we still can't find a menu
	if ( ! $menu && !$args->theme_location ) {
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu_maybe ) {
			if ( $menu_items = wp_get_nav_menu_items($menu_maybe->term_id) ) {
				$menu = $menu_maybe;
				break;
			}
		}
	}

	// If the menu exists, get its items.
	if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
		$menu_items = wp_get_nav_menu_items( $menu->term_id );

	// If no fallback function was specified and the menu doesn't exists, bail.
	if ( !$menu || is_wp_error($menu) )
		return false;

	$nav_menu = $items = '';

	$show_container = false;

	$sorted_menu_items = array();
	foreach ( (array) $menu_items as $key => $menu_item )
		$sorted_menu_items[$menu_item->menu_order] = $menu_item;

	unset($menu_items);

	$sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

	$items .= walk_footer_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
	unset($sorted_menu_items);

	$wrap_class = $args->menu_class ? $args->menu_class : '';

	$nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), "footer-menu", $items );
	unset( $items );

	if ( $show_container )
		$nav_menu .= '</' . $args->container . '>';

	$nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );

	if ( $args->echo )
		echo $nav_menu;
	else
		return $nav_menu;
}

/**
 * Retrieve the HTML list content for nav menu items.
 *
 * @uses footer_walker_nav to create HTML list content.
 * @since 3.0.0
 * @see Walker::walk() for parameters and return description.
 * 
 * This function is only modified slightly so that it uses my modified walker.
 */
function walk_footer_nav_menu_tree( $items, $depth, $r ) {
	$walker = ( empty($r->walker) ) ? new footer_walker_nav : $r->walker;
	$args = array( $items, $depth, $r );

	return call_user_func_array( array(&$walker, 'walk'), $args );
}
