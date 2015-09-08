<?php 


/* ============================================================================

  CLEAN WP HEADER

  - Removes new emoji settings

  - Remove Feed links

  - Remove Generator tags, hiding version number

  - Remove WooCommerce Stylesheets

============================================================================ */

function clean_wp_header() {

  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );

  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'feed_links', 2 );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'index_rel_link' );
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_head', 'wp_generator' );

  // add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

}

add_action( 'after_setup_theme', 'clean_wp_header' );


/* ============================================================================

  Further WordPress Cleanup

===============================================================================

  SOIL

  - Cleans up the head section in WordPress, linked with Soil plugin

============================================================================ */

add_theme_support( 'soil-clean-up' );

add_theme_support( 'soil-nice-search' );

add_theme_support( 'soil-relative-urls' );

add_theme_support( 'soil-disable-trackbacks' );

add_theme_support( 'soil-disable-asset-versioning' );


/* ============================================================================

  SANITIZE

  - Strips out all unneeded white space

============================================================================ */

$ignoreSanitize = true;

if ( $ignoreSanitize != true ) :

  function sanitize_output( $buffer ) {

    $search = array(
      '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
      '/[^\S ]+\</s',  // strip whitespaces before tags, except space
      '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace( $search, $replace, $buffer );

    return $buffer;

  }

  ob_start( 'sanitize_output' );

endif;


