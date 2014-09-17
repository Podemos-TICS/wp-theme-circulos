<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="es"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 9]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
  <?php if ( (is_home()) || (is_front_page()) ) { ?>
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?> </title>
    <?php } elseif (is_single()) { ?>
      <title><?php bloginfo( 'name' ); ?> - <?php wp_title(''); ?> </title>
  <?php } ?>
  <meta charset="utf-8"/>
  <meta name="language" content="es" />
  <meta name="distribution" content="global" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <?php if ( (is_home()) || (is_front_page()) ) { ?>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>" />
    <?php } elseif (is_single()) { ?>
      <meta name="description" content="<?php echo get_the_excerpt(); ?>" />
  <?php } ?>

  <?php
      $postTags = get_the_tags();
      $tagNames = array();
      foreach($postTags as $tag)
      {
          $tagNames[] = $tag->name;
      }
  ?>
  <meta name="keywords" content="<?php echo implode($tagNames,", "); ?>" />


  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

  <!-- Mobile Specific Metas  -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
  <meta name="format-detection" content="telephone=no">

  <!-- Facebook Metadata /-->
  <meta property="fb:page_id" content="<?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?>" />
  <meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail.jpg" />
  <meta property="og:description" content="<?php bloginfo( 'description' ); ?>"/>
  <meta property="og:title" content="<?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?>"/>

  <!-- Google+ Metadata /-->
  <meta itemprop="name" content="<?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?>">
  <meta itemprop="description" content="<?php bloginfo( 'description' ); ?>">
  <meta itemprop="image" content="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail.jpg">

  <!-- Icons /-->
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-57x57-precomposed.png" type="image/x-icon" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-57x57-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-72x72-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-114x114-precomposed.png"/>
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-144x144-precomposed.png"/>

  <!-- Javscript /-->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr.min.js"></script>

  <!-- Includes /-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
