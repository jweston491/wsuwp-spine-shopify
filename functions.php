<?php

// Two Navigation Menus
add_action( 'init', 'spine_menus' );
function spine_menus() {
	register_nav_menus(
		array(
		'site' => 'Site',
		'offsite' => 'Offsite'
		)
	);
}

// A Single Sidebar
add_action( 'widgets_init', 'spine_theme_widgets_init' );
/**
 * Register sidebars used by the theme.
 */
function spine_theme_widgets_init() {
	// A Single Sidebar
	register_sidebar(array(
		'name' => 'Sidebar',
		'description' => __( 'Widgets in this area will be shown on the right-hand side.' ),
		'before_title' => '<header>',
		'after_title' => '</header>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
	));
}

add_action( 'after_setup_theme', 'spine_theme_setup_theme' );
/**
 * Setup some defaults provided by the theme.
 */
function spine_theme_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 198, 198, true );

	add_image_size( 'teaser-image', 198, 198, true );
	add_image_size( 'header-image', 792, 99163 );
	add_image_size( 'billboard-image', 1584, 99163 );
}



// DEFAULTS

// Condense verbose menu classes
add_filter( 'nav_menu_css_class', 'abbridged_menu_classes', 10, 3 );
function abbridged_menu_classes( $classes, $item, $args ) {
	if ( in_array( 'current-menu-item', $classes ) )
		return array( 'current' );
	return array();	
}

add_action( 'admin_init', 'spine_theme_image_options' );
function wsuwp_spine_image_options() {
	// Default Image Sizes
	update_option( 'thumbnail_size_w', 198   );
	update_option( 'thumbnail_size_h', 198   );
	update_option( 'medium_size_w',    396   );
	update_option( 'medium_size_h',    99163 );
	update_option( 'large_size_w',     792   );
	update_option( 'large_size_h',     99163 );
	// update_option('full_size_w', 1980);
	// update_option('full_size_h', 99163);
}

/* Default Image Markup */

add_filter( 'img_caption_shortcode', 'caption_markup', 10, 3 );

function caption_markup( $output, $attr, $content ) {
	if ( is_feed() )
		return $output;
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);
	$attr = shortcode_atts( $defaults, $attr );
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;
	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="' . esc_attr( $attr['align'] ) . '"';
	$output = '<figure' . $attributes .'><div class="liner cf">';
	$output .= do_shortcode( $content );
	$output .= '<figcaption>' . $attr['caption'] . '</figcaption>';
	$output .= '</div></figure>';
	return $output;
}

/* add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
} */

/* function image_tag_class($class, $id, $align, $size) {
	return $align;
}
add_filter('get_image_tag_class', 'image_tag_class', 0, 4);

*/

// Sectioning
function is_subpage() {
    global $post;
    if ( is_page() && $post->post_parent ) {
        return $post->post_parent;
    } else { return false; }
}

function section_title(){
	global $post;
	if ( is_page() && $post->post_parent ) {
		$parents = array_reverse(get_post_ancestors($post->id));
		$topmost_parent = get_page($parents[0]);
		return $topmost_parent->post_title;
		}
	else {
		return $post->post_title;
		}
	}
function section_slug(){
	global $post;
	if ( is_page() && $post->post_parent ) {
		$parents = array_reverse(get_post_ancestors($post->id));
		$topmost_parent = get_page($parents[0]);
		return $topmost_parent->post_name;
		}
	else {
		return $post->post_name;
		}
	}

// Default Widget Markup
if (function_exists('register_sidebar')) {
        $widget_options = array(
        'name' => __( 'Sidebar', 'sidebar' ),
        'id' => 'sidebar',
        'before_widget' =>  '<aside id="%1$s2" class="%2$s">',
        'after_widget'  =>  '</aside>',
        'before_title'  =>  '<header>',
        'after_title'   =>  '</header>'
    );
    register_sidebar($widget_options);
}

// Default Read More
function spine_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More</a>';
}
add_filter( 'excerpt_more', 'spine_excerpt_more' );

// Extend Body Class 

add_filter('body_class','extend_body_classes');
function extend_body_classes($classes) {
	$stippled = 'stippled-'.mt_rand(0,19); // Add Randomizer
	$classes[] = $stippled;
	return $classes;
}

// CUSTOMIZATION
include_once('admin/customizer.php');

// TEMPLATES

// ADMIN MODS

// Add CSS files
function spine_theme_admin_styles() {
    wp_enqueue_style('admin-interface-styles', get_template_directory_uri() . '/admin/admin.css');
    add_editor_style('admin-editor-styles', get_template_directory_uri() . '/admin/editor.css');
}
add_action('admin_enqueue_scripts', 'spine_theme_admin_styles');


// Ad Hoc Sections
// include_once('admin/sections.php');