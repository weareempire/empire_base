<?php /* ======================================================================

  IMPORT ADVANCED CUSTOM FIELDS

============================================================================ */

if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Empire Settings',
    'menu_title'  => 'EMP Settings',
    'menu_slug'   => 'general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
  
}

