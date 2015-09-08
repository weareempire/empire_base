<!DOCTYPE html>
<html lang="en-GB">

  <head>

    <meta http-equiv="Cache-control" content="public">

    <meta charset="UTF-8">

    <title><?php echo WP_DEBUG_LOG  .':'. WP_DEBUG_DISPLAY;  if ( !defined( 'WP_DEBUG' ) || WP_DEBUG == false ) : echo 'not debugging'; else : echo 'debugging'; endif; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <?php if ( strpos( IS_DEV, 'youareempire' ) ) : ?><meta name="robots" content="noindex, nofollow"><?php endif; ?>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">

    <meta property="og:locale" content="en_GB">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php the_title(); ?> - <?php bloginfo( 'name' ); ?>">
    <meta property="og:url" content="<?php bloginfo( 'url' ); ?>">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@weareempireuk">
    <meta name="twitter:title" content="<?php the_title(); ?>">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
    <meta name="twitter:url" content="<?php bloginfo( 'url' ); ?>">
    <?php if(get_field('fav_ico','option') ): ?>
      <link rel="shortcut icon" href="<?php the_field('fav_ico','option');?>">
    <?php endif; ?>
    <?php if(get_field('apple_touch_logo','option') ): ?>
      <link rel="apple-touch-icon" href="<?php the_field('apple_touch_logo','option');?>">
    <?php endif; ?>
    <?php if(get_field('google_fonts_link','option') ): ?>
      <?php the_field('google_fonts_link','option'); ?>
    <?php endif; ?>
    <?php if(get_field('typekit_id','option') ): ?>
      <script src="//use.typekit.net/<?php the_field('typekit_id','option'); ?>.js"></script>
      <script>try{Typekit.load();}catch(e){}</script>
    <?php endif; ?>
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/assets/css/style.css">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'url' ); ?>/feed/">

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        
    <![endif]-->

    <?php if(get_field('google_analtics_id','option') ): ?>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', "<?php the_field('google_analtics_id','option');?>", 'auto');
        ga('send', 'pageview');

      </script>
    <?php endif; ?>

  </head>

  <body id="<?php if ( is_front_page() ) : ?>home<?php else : ?>general<?php endif; ?>" <?php body_class( 'inc-menu' ); ?>>

    <div id="page">

        <header class="header" id="header" role="banner">

          <div class="container">

            <a class="brand" id="brand" href="<?php bloginfo( 'url' ); ?>">
              <?php if(get_field('logo','option') ): ?>
                <img src="<?php the_field('logo','option');?>">
              <?php endif; ?>
            </a>

            <a class="empireMenu" id="empireMenu__control" href="#">menu</a>

            <?php wp_nav_menu( array(

                'theme_location'    => 'primary',
                'container'         => 'div',
                'container_id'      => 'wp_menu',
                'container_class'   => false,
                'menu_class'        => false, 
                'echo'              => true,
                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>'

            ) ); ?>

          </div>
          
        </header>

        <section class="content" id="content">

          <div class="container"></div>

        </section>