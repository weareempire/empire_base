<?php /* ======================================================================
  IMPORT ADVANCED CUSTOM FIELDS
============================================================================ */

if ( function_exists( 'acf_add_options_page' ) ) {
  
  acf_add_options_page( array(

    'page_title'  => 'Empire Settings',
    'menu_title'  => 'EMP Settings',
    'menu_slug'   => 'general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false

  ));
  
}


/* ============================================================================
  RETURN META DATA TO SUPPORT RESPONSIVE STYLING
============================================================================ */

function emp_getMobileProperties() {

// MAKE SITE WEB APP CAPABLE
  $meta .= '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";

// SET STATUS BAR COLOUR
  $meta .= '<meta name="apple-mobile-web-app-status-bar-style" content="black">' . "\n";

// SET WEB APP TITLE
  $meta .= '<meta name="apple-mobile-web-app-title" content="' . get_bloginfo( 'name' ) . '">' . "\n";

// SET VIEWPORT
  $meta .= '<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">' . "\n";

// RETUN META
  return $meta;

}


/* ============================================================================
  RETURN META DATA TO SUPPORT RESPONSIVE STYLING
============================================================================ */

function emp_getSocialProperties() {

  $facebook .= '<meta property="og:locale" content="en_GB">' . "\n";
  $facebook .= '<meta property="og:type" content="website">' . "\n";
  $facebook .= '<meta property="og:title" content="' . get_the_title() . ' - ' . get_bloginfo( 'name' ) . '">' . "\n";
  $facebook .= '<meta property="og:url" content="' . get_bloginfo( 'url' ) . '">' . "\n";
  $facebook .= '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '">' . "\n";

  $twitter .= '<meta name="twitter:card" content="summary">' . "\n";
  $twitter .= '<meta name="twitter:site" content="@weareempireuk">' . "\n";
  $twitter .= '<meta name="twitter:title" content="' . get_the_title() . '">' . "\n";
  $twitter .= '<meta name="twitter:description" content="">' . "\n";
  $twitter .= '<meta name="twitter:image" content="">' . "\n";
  $twitter .= '<meta name="twitter:url" content="' . get_bloginfo( 'url' ) . '">' . "\n";

  $social = $facebook . $twitter;

  return $social;

}


/* ======================================================================


  Custom Nav Walker

============================================================================ */

class custom_walker extends Walker_Nav_Menu {

  function start_el( &$output, $item, $depth = 0, $args = array() ) {

    global $wp_query;

    $indent = ( $depth ) ? str_repeat( $depth ) : '';
    
    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : ( array ) $item->classes;

    $current_indicators = array( 'current-menu-item', 'current-menu-parent' );

    $newClasses = array();

    foreach( $classes as $el ) {

//check if it's indicating the current page, otherwise we don't need the class
      if ( in_array( $el, $current_indicators ) ) {

        array_push( $newClasses, $el );

      }

    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $newClasses ), $item ) );

    if ( $class_names != '' ) $class_names = ' class="active"';

    $output .= $indent . '<li' . $value . '>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    if ( $depth != 0 ) {}

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '' . $class_names . '>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

  }

}


/* ============================================================================

  THEME SCRIPTS

============================================================================ */

function theme_scripts() {

  wp_deregister_script( 'jquery' );

  wp_register_script( 'jquery', 'http' . ( $_SERVER[ 'SERVER_PORT' ] == 443 ? "s" : "" ) . '://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, null );

  wp_enqueue_script( 'jquery' );

}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );



/* ============================================================================

  WORDPRESS MENUS

===============================================================================

  - Register custom menus

  - Create Custom Walker, strips out unnecessary classes

============================================================================ */

register_nav_menus( array(

  'primary'   => __( 'Primary', 'empire_base' ), 
  'secondary' => __( 'Secondary', 'empire_base' ),
  'footer'    => __( 'Footer', 'empire_base' )

) );


/* ============================================================================

  ACF FULL WIDTH

============================================================================ */

add_action( 'admin_head', 'acf_full_width' );

function acf_full_width() {

  echo '<style>';
  echo '.acf-field { max-width: none !important; }';
  echo '#wpbody-content{ overflow: hidden !important; }';
  echo '</style>';

}

