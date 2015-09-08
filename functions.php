<?php

  if ( file_exists( TEMPLATEPATH . '/update/update.php' ) ) :

    require_once( TEMPLATEPATH . '/update/update.php' );

  endif;

  if ( file_exists( get_template_directory() . '/functions/general/functions.php' ) ) :

    include_once( get_template_directory() . '/functions/general/functions.php' );

  endif;






