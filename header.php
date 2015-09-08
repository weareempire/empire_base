<!DOCTYPE html>
<html lang="en-GB">

  <head>

    <meta http-equiv="Cache-control" content="public">

    <meta charset="UTF-8">

    <title></title>
    <meta name="description" content="">

<?php echo emp_getMobileProperties(); ?>

<?php echo emp_getSocialProperties(); ?>



    <?php /* if(get_field('fav_ico','option') ): ?>
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
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/assets/css/main.css">

    <?php if(get_field('google_analtics_id','option') ): ?>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', "<?php the_field('google_analtics_id','option');?>", 'auto');
        ga('send', 'pageview');

      </script>
    <?php endif; */ ?>

    <?php wp_head(); ?>

  </head>

  <body id="<?php if ( is_front_page() ) : ?>home<?php else : ?>general<?php endif; ?>" <?php body_class( 'inc-menu' ); ?>>

    <div id="page">

        <header class="header" id="header" role="banner">

          <div class="container">
<?php /*
            <a class="brand" id="brand" href="<?php bloginfo( 'url' ); ?>">
              <?php if(get_field('logo','option') ): ?>
                <img src="<?php the_field('logo','option');?>">
              <?php endif; ?>
            </a>

            <a class="empireMenu" id="empireMenu__control" href="#">menu</a>
*/ ?>
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