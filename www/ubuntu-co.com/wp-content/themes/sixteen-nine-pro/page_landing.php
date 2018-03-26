<?php
/**
 * This file adds the Landing template to the Sixteen Nine Pro Theme.
 *
 * @author StudioPress
 * @package Generate
 * @subpackage Customizations
 */

/*
Template Name: Landing
*/

// Add custom body class to the head
add_filter( 'body_class', 'sixteen_nine_add_body_class' );
function sixteen_nine_add_body_class( $classes ) {
   $classes[] = 'sixteen-nine-landing';
   return $classes;
}

// Remove header, navigation, breadcrumbs, footer widgets, footer 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_header', 'sixteen_nine_site_gravatar', 5 );
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_seo_site_description' );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action( 'genesis_header', 'genesis_footer_markup_open', 11 );
remove_action( 'genesis_header', 'genesis_do_footer', 12 );
remove_action( 'genesis_header', 'genesis_footer_markup_close', 13 );

genesis();