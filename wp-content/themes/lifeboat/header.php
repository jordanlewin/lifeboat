<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <!-- <title><?php wp_title('', true, 'right'); ?></title> -->
  <title><?php wp_title('|','true','right'); bloginfo('name'); print (is_front_page()) ? ' | Friends At Their Best' : ''; ?></title>
      
  <meta name="viewport" content="width=device-width; initial-scale=1.0">
  
  <!-- Add Adaptive Images :: http://adaptive-images.com -->
  <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
  
  <!-- icons & favicons -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
      
  <!-- media-queries.js (fallback) -->
  <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>     
  <![endif]-->

  <!-- html5.js -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    
  <!-- wordpress head functions -->
  <?php wp_head(); ?>
  <!-- end of wordpress head -->

  <!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> -->
      
</head>

<body <?php (is_front_page()) ? body_class() : body_class('inside'); ?>>

  <!-- Begin Custom Header Markup -->
  <header id="header"><a id="top"></a>
    <?php if (is_front_page()) : ?>
    <?php get_template_part('slider', 'home'); ?>
    <? endif; ?>
    <div class="nav container">
      <div class="row">
        <div class="four columns">
          <div id="logo"><a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/lifeboat-logo.png" alt="<?php bloginfo('name'); ?> // <?php echo get_bloginfo ( 'description' ); ?>"></a></div>
          <nav id="mobile-primary" class="show-for-small">
            <div class="mobile-primary-inner">
              <?php lifeboat_mobile_primary_nav(); ?>
            </div><!-- mobile-primary-inner -->
            <div class="mobile-primary-btm"></div>
          </nav>
        </div><!-- four columns -->
        <div class="thirteen columns offset-by-one hide-for-small">
          <nav id="primary">
            <?php lifeboat_primary_nav(); // Adjust using Menus in Wordpress Admin ?>
          </nav><!-- primary -->
        </div><!-- thirteen columns offset-by-one hide-for-small -->
      </div><!-- row -->
    </div><!-- nav container -->
  </header><!-- header -->

  <div id="main-container" class="container">
  <!-- End Custom Header Markup -->