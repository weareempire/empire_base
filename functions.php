<?php


/* ============================================================================
  Include update directory to allow theme updates
===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

============================================================================ */

  if ( file_exists( TEMPLATEPATH . '/update/index.php' ) ) :

    require_once( TEMPLATEPATH . '/update/index.php' );

  endif;


/* ============================================================================
  Include General WordPress functions, filters and actions
===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

  - Generic functions including:

    - acf_add_options_page
    - emp_getMobileProperties
    - emp_getSocialProperties
    - custom_walker

============================================================================ */

  if ( file_exists( get_template_directory() . '/functions/general/functions.php' ) ) :

    include_once( get_template_directory() . '/functions/general/functions.php' );

  endif;


/* ============================================================================
  Include Optimisation functions, filters and actions
===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

  - Optimisation functions including:

    - clean_wp_header
    - Soil
    - Sanitize

============================================================================ */

  if ( file_exists( get_template_directory() . '/functions/woocommerce/functions.php' ) ) :

    include_once( get_template_directory() . '/functions/woocommerce/functions.php' );

  endif;


/* ============================================================================
  Include WooCommerce functions, filters and actions
===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

  - WooCommerce functions including:

    - 

  - Checks if the plugin is activated before including

============================================================================ */

  if ( is_plugin_active( 'woocommerce/woocommerce.php' ) && file_exists( get_template_directory() . '/functions/woocommerce/functions.php' ) ) :

    include_once( get_template_directory() . '/functions/woocommerce/functions.php' );

  endif;




