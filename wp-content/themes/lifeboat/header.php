<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <title><?php wp_title('', true, 'right'); ?></title>
      
  <meta name="viewport" content="width=device-width; initial-scale=1.0">
  
  <!-- Add Adaptive Images :: http://adaptive-images.com -->
  <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
  
  <!-- icons & favicons -->
  <!-- For iPhone 4 -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/h/apple-touch-icon.png">
  <!-- For iPad 1-->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/m/apple-touch-icon.png">
  <!-- For iPhone 3G, iPod Touch and Android -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/l/apple-touch-icon-precomposed.png">
  <!-- For Nokia -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/l/apple-touch-icon.png">
  <!-- For everything else -->
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
    <div id="home-slider" class="container">
      <div class="slider">
        <div class="slide" style="background-image: url(/wp-content/uploads/2013/02/home-slider-1.jpg);">
          <div class="row">
            <div class="four columns"></div>
            <div class="thirteen columns offset-by-one">
              <a href="" class="button feature">
                <span class="button-inner">
                  <span class="button-text">Turn on Your Friends</span>
                  <span class="icon" style="background-image: url(/wp-content/themes/lifeboat/images/icon-flag.svg);"></span>
                  <span class="button-text">Share the Manifesto</span>
                </span>
              </a>
            </div><!-- thirteen columns -->
          </div><!-- row -->
        </div><!-- slide -->
        <div class="slide" style="background-image: url(/wp-content/uploads/2013/02/home-slider-2.jpg);">
          <div class="row">
            <div class="four columns"></div>
            <div class="thirteen columns offset-by-one">
              <a href="" class="button feature">
                <span class="button-inner">
                  <span class="button-text">What is Lifeboat?</span>
                  <span class="icon" style="background-image: url(/wp-content/themes/lifeboat/images/icon-flag.svg);"></span>
                  <span class="button-text">Watch the Video</span>
                </span>
              </a>
            </div><!-- thirteen columns -->
          </div><!-- row -->
        </div><!-- slide -->
        <div class="slide" style="background-image: url(/wp-content/uploads/2013/02/home-slider-3.jpg);">
          <div class="row">
            <div class="four columns"></div>
            <div class="thirteen columns offset-by-one">
              <a href="" class="button feature">
                <span class="button-inner">
                  <span class="button-text">Lorem Ipsum Dolor</span>
                  <span class="icon" style="background-image: url(/wp-content/themes/lifeboat/images/icon-flag.svg);"></span>
                  <span class="button-text">Sit Amet Adelfus</span>
                </span>
              </a>
            </div><!-- thirteen columns -->
          </div><!-- row -->
        </div><!-- slide -->
      </div><!-- home-slider -->
    </div><!-- slider container -->
    <? endif; ?>
    <div class="nav container">
      <div class="row">
        <div class="four columns">
          <div id="logo"><a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/lifeboat-logo@2x.png" alt="<?php bloginfo('name'); ?> // <?php echo get_bloginfo ( 'description' ); ?>"></a></div>
          <nav id="mobile-primary" class="show-for-small">Mobile nav here.</nav>
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