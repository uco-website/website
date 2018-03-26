<?php
/**
 * functions.php for ubuntu-loco theme
 */
?>
<?php

/**
 * Return the current loaded language
 *
 * @param String $lang the language identifier like 'en' or 'ru'
 */
function is_lang($l) {
    global $q_config;
    if(isset($q_config["language"]) && $l == $q_config["language"])
        return true;
    else
        return false;
}

/**
 * Add rounded corners script for handling border-radius
 * Load inits
 */
function ubuntu_loco_js_scripts() {
    wp_enqueue_script( 'jquery-corner', get_bloginfo('stylesheet_directory').'/js/jquery.corner.js', array('jquery'), '2.08' );
    wp_enqueue_script( 'nivo-slider', get_bloginfo('stylesheet_directory').'/js/slider/jquery.nivo.slider.pack.js', array('jquery'), '2' );
    wp_enqueue_style( 'nivo-slider', get_bloginfo('stylesheet_directory').'/js/slider/nivo-slider.css', null, '2' );
    wp_enqueue_script( 'ubuntu-loco', get_bloginfo('stylesheet_directory').'/js/ubuntu-loco.js', array('jquery-corner', 'nivo-slider'), '0.2-light', true );
}

/**
 * Load our favicon
 */
function ubuntu_loco_favicon() { ?>
<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.ico" type="image/x-icon" />
<?php }

/**
 * Add Chrome Frame support
 */
function ubuntu_loco_chrome_frame() { ?>
<meta http-equiv="X-UA-Compatible" content="chrome=1" />
<?php }

/**
 * Remove stuff (title, description, superfish)
 */
function ubuntu_loco_remove_add_stuff() {
    //unloads
    remove_action( 'wp_head', 'thematic_head_scripts' );
    remove_action( 'thematic_header', 'thematic_access', 9 );
    remove_action('thematic_navigation_above', 'thematic_nav_above', 2);
    //loads
    wp_enqueue_script('jquery');
    add_action( 'ubuntu_loco_search', 'ubuntu_loco_add_search' );
    // new widget areas
    register_sidebar( array (
        'name' => __( 'Menu', 'light-wordpress-theme' ),
        'id' => 'primary-header-menu',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget'  => "</li>",
        'before_title'  => '',
        'after_title'   => '',
        'description'   => __( 'Main navigation menu.', 'light-wordpress-theme' ),
    ) );
    register_sidebar( array (
        'name' => __( 'Sub Menu', 'light-wordpress-theme' ),
        'id' => 'secondary-header-menu',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget'  => "</li>",
        'before_title'  => '',
        'after_title'   => '',
        'description'   => __( 'Secondary navigation menu.', 'light-wordpress-theme' ),
    ) );
}

/**
 * Add searchbox into header
 */
function ubuntu_loco_add_search(){
    include (TEMPLATEPATH . '/searchform.php');
}

/**
 * Overwrite primary and secondary assides to hide from frontpage
 */ 
function ubuntu_loco_asides($content) {
    $content['Primary Aside']['function'] = 'ubuntu_loco_primary_aside';
    $content['Secondary Aside']['function'] = 'ubuntu_loco_secondary_aside';
    //move this outside #content
    $content['Page Top']['action_hook'] = 'thematic_belowheader';
    $content['Page Bottom']['action_hook'] = 'thematic_belowmainasides';
    // Rename Page Top/Bottom into Header and Above Footer.
    $content['Page Top']['args']['name'] = __( 'Below Header', 'light-wordpress-theme' );
    $content['Page Bottom']['args']['name'] = __( 'Above Footer', 'light-wordpress-theme' );
    // Remove some asides
    unset($content['Index Top']);
    unset($content['Index Insert']);
    unset($content['Index Bottom']);
    unset($content['Single Top']);
    unset($content['Single Insert']);
    unset($content['Single Bottom']);
    
    return $content;
}

/**
 * ubuntu_loco_subpages()
 *
 * Generates kids of current page, if none, shows parents
 * @return String the generated content
 */
function ubuntu_loco_subpages() {
    global $wp_query;
    $p = $wp_query->post;
    
    if( is_404() || is_search() )
        return ;
    
    $children = wp_list_pages( array(
        'echo' => 0,
        'title_li' => '',
        'depth' => '',
        'sort_column'  => 'menu_order, post_title',
        'child_of' => $p->ID,
    ) );
    
    if( !$children )
        if ( $p->post_parent )
            $children = wp_list_pages( array(
                'echo' => 0,
                'title_li' => '',
                'depth' => '',
                'sort_column'  => 'menu_order, post_title',
                'child_of' => $p->post_parent,
            ) );
    
    return $children;
}

/**
 * ubuntu_loco_post_cats()
 *
 * Generate lists for categories
 */
function ubuntu_loco_post_cats() {
    $cats = get_the_category();
    $label = '';
    if( count( $cats ) > 1 )
        $label = __( 'Categories' ) . ': ';
    else if( count( $cats ) == 1 )
        $label = __( 'Category' ) . ': ';
    
    $content = '<div class="cat-links">';
    //$content .= $label;
    $content .= get_the_category_list();
    $content .= '</div>';
    
    if( !empty( $cats ) )
        return $content;
}

/**
 * ubuntu_loco_post_tags()
 *
 * Generate lists for tags
 */
function ubuntu_loco_post_tags() {
    $tags = get_the_tags( get_the_ID() );
    $label = '';
    if( count( $tags ) > 1 )
        $label = __( 'Tags' ) . ': ';
    else if( count( $tags ) == 1 )
        $label = __( 'Tag' ) . ': ';
    
    $content = '<div class="tag-links">';
    //$content .= $label;
    $content .= get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
    $content .= '</div>';
    
    if( !empty( $tags ) )
        return $content;
}

function ubuntu_loco_primary_aside() {
    if ( ( !is_front_page() && !is_page() ) || ( is_front_page() && is_home() ) ) {
        if (is_sidebar_active('primary-aside')) {
            echo thematic_before_widget_area('primary-aside');
            dynamic_sidebar('primary-aside');
            echo thematic_after_widget_area('primary-aside');
        }
    }
}

function ubuntu_loco_secondary_aside() {
    if ( ( !is_front_page() && !is_page() ) || ( is_front_page() && is_home() ) ) {
        if (is_sidebar_active('secondary-aside')) {
            echo thematic_before_widget_area('secondary-aside');
            dynamic_sidebar('secondary-aside');
            echo thematic_after_widget_area('secondary-aside');
        }
    }
}

function ubuntu_loco_topbar() { ?>
    <div id="top-bar">
        <?php if (is_sidebar_active('top-bar-container')): ?>
            <div class="top-bar-container">
                <div class="top-bar-container">
                    <ul>
                        <li><a href="http://www.ubuntu.com"><?php _e( 'Ubuntu.com', 'light-wordpress-theme' ); ?></a></li>
                        <li><a href="http://www.ubuntu.com/community"><?php _e( 'Community' , 'light-wordpress-theme' ); ?></a></li>
                        <li><a href="http://www.ubuntu.com/support"><?php _e( 'Support', 'light-wordpress-theme' ); ?></a></li>
                        <li><a href="http://www.ubuntu.com/partners"><?php _e( 'Partners', 'light-wordpress-theme' ); ?></a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php }

function ubuntu_loco_access() { ?>
    <div id="access">
        <div id="loco-header-menu">
            <ul id="primary-header-menu">
                <?php
                    dynamic_sidebar('primary-header-menu');
                ?>
            </ul>
        </div>
    </div>
<?php }

function ubuntu_loco_below_header() { ?>
    <div id="secondary-header">
        <div id="secondary-access">
            <div id="loco-search-form">
                <?php do_action( 'ubuntu_loco_search' ); ?>
            </div>
            <div id="loco-sub-header-menu">
                <?php
                $c = ubuntu_loco_subpages();
                if( $c ):
                ?>
                <ul id="secondary-header-menu">
                    <?php echo $c; ?>
                </ul>
                <?php else : ?>
                <ul id="dynamic-secondary-header-menu">
                    <?php dynamic_sidebar('secondary-header-menu'); ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php }

/**
 * Add site name to <title>
 */
function ubuntu_loco_doctitle( $elements ) {
    if( !is_home() || !is_front_page() ) {
        $content = $elements['content'];
        // Reset $elements to get proper ordering of $content at the end
        unset( $elements );
        $elements['site_name'] = get_bloginfo('name');
        $elements['separator'] = '|';
        $elements['content'] = $content;
    }
    
    return $elements;
}

/**
 * Remove search tip from search form
 */
function ubuntu_loco_search_field_value( $value ) {
    // Do not return anything and leave it blank. 
    $value = '';
    return $value;
}

/**
 * Disable thematic auto comments handling
 */
define('THEMATIC_COMPATIBLE_COMMENT_HANDLING', true);

/**
 * Load actions and filters
 */
add_action('init','ubuntu_loco_remove_add_stuff');
add_action('init','ubuntu_loco_js_scripts');
add_action('wp_head', 'ubuntu_loco_favicon');
add_action('wp_head', 'ubuntu_loco_chrome_frame');
add_action('thematic_aboveheader','ubuntu_loco_topbar');
add_action('thematic_header','ubuntu_loco_access', 9);
add_action('thematic_belowheader','ubuntu_loco_below_header',1);
add_filter('thematic_doctitle', 'ubuntu_loco_doctitle');
add_filter('search_field_value', 'ubuntu_loco_search_field_value');
add_filter('thematic_postfooter_postcategory', 'ubuntu_loco_post_cats');
add_filter('thematic_postfooter_posttags', 'ubuntu_loco_post_tags');
add_filter('thematic_postfooter_postcomments', create_function( '', 'return null;' ) );
add_filter('thematic_postfooter_postconnect', create_function( '', 'return null;' ) );
add_filter('thematic_widgetized_areas','ubuntu_loco_asides');
?>
