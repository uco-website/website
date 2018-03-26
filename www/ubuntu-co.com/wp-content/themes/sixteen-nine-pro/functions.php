<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'sixteen-nine', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'sixteen-nine' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Sixteen Nine Pro Theme', 'sixteen-nine' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/sixteen-nine/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background', array( 'wp-head-callback' => '__return_false' ) );

//* Unregister layout settings
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'admin-preview-callback' => 'sixteen_nine_admin_header_callback',
	'default-text-color'     => 'ffffff',
	'header-selector'        => '.site-header .site-avatar img',
	'height'                 => 224,
	'width'                  => 224,
) );

function sixteen_nine_admin_header_callback() {
	echo get_header_image() ? '<img src="' . get_header_image() . '" />' : get_avatar( get_option( 'admin_email' ), 224 );
}

//* Load Playfair Displsy and Roboto family of Google fonts
add_action( 'wp_enqueue_scripts', 'sixteen_nine_google_fonts' );
function sixteen_nine_google_fonts() {

	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Playfair+Display:300italic|Roboto:300,700|Roboto+Condensed:300,700|Roboto+Slab:300', array(), PARENT_THEME_VERSION );

}

//* Load Backstretch script and prepare images for loading
add_action( 'wp_enqueue_scripts', 'sixteen_nine_enqueue_scripts' );
function sixteen_nine_enqueue_scripts() {

	wp_enqueue_script( 'sixteen-nine-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	//* Load scripts only if custom background is being used
	if ( ! get_background_image() )
		return;

	wp_enqueue_script( 'sixteen-nine-backstretch', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'sixteen-nine-backstretch-set', get_bloginfo('stylesheet_directory').'/js/backstretch-set.js' , array( 'jquery', 'sixteen-nine-backstretch' ), '1.0.0' );
	wp_localize_script( 'sixteen-nine-backstretch-set', 'BackStretchImg', array( 'src' => get_background_image() ) );

}

//* Hook site avatar before site title
add_action( 'genesis_header', 'sixteen_nine_site_gravatar', 5 );
function sixteen_nine_site_gravatar() {

	$header_image = get_header_image() ? '<img alt="" src="' . get_header_image() . '" />' : get_avatar( get_option( 'admin_email' ), 224 );
	
	printf( '<div class="site-avatar"><a href="%s">%s</a></div>', home_url( '/' ), $header_image );

}

//* Hook after post widget after the entry content
add_action( 'genesis_after_entry', 'sixteen_nine_after_entry', 5 );
function sixteen_nine_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry" class="widget-area">',
			'after'	 => '</div>',
		) );

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'sixteen_nine_author_box_gravatar' );
function sixteen_nine_author_box_gravatar( $size ) {

	return 140;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'sixteen_nine_comments_gravatar' );
function sixteen_nine_comments_gravatar( $args ) {

	$args['avatar_size'] = 96;

	return $args;

}

//* Reposition the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
add_action( 'genesis_header', 'genesis_footer_markup_open', 11 );
add_action( 'genesis_header', 'genesis_do_footer', 12 );
add_action( 'genesis_header', 'genesis_footer_markup_close', 13 );

//* Customize the footer
add_filter( 'genesis_footer_output', 'sixteen_nine_custom_footer' );
function sixteen_nine_custom_footer( $output ) {

	$output = sprintf( '<p>%s<a href="http://www.studiopress.com/">%s</a></p>',  __( 'Powered by ', 'sixteen-nine' ), __( 'Genesis', 'sixteen-nine' ) );
	return $output;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'sixteen-nine' ),
	'description' => __( 'This is the widget that appears after the entry on single posts.', 'sixteen-nine' ),
) );