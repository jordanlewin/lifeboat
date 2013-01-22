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

<body <?php body_class(); ?>>

  <!-- Begin Custom Header Markup -->
  <header id="header">
    <?php if (is_front_page()) : ?>
    <div class="slider container">
      <div id="home-slider">
        <div class="slide">
          <img src="/wp-content/themes/lifeboat/images/samples/home-slider-1.jpg" alt="Test Slider Image 1">
        </div><!-- slide -->
      </div><!-- home-slider -->
      <div class="nav-bg"></div>
    </div><!-- slider container -->
    <? endif; ?>
  	<div class="row">
  		<div class="four columns">
  		  <div id="logo"><a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/lifeboat-logo@2x.png" alt="<?php bloginfo('name'); ?> // <?php echo get_bloginfo ( 'description' ); ?>"></a></div>
  			<nav id="mobile-primary" class="show-for-small">Mobile nav here.</nav>
  		</div><!-- four columns -->
  		<div class="thirteen columns offset-by-one hide-for-small">
  			<nav id="primary">
    		  <?php lifeboat_primary_nav(); // Adjust using Menus in Wordpress Admin ?>
    			<!-- <p><span>Learn </span>About<span> Lifeboat</span> // <span>Visit the Friend </span>Blog // <span>Get </span>Start<span>ed</span> // <span>Explore </span>Goodies // <span>Request a Friendly </span>Speaker</p> -->
  			</nav><!-- primary -->
  		</div><!-- thirteen columns offset-by-one hide-for-small -->
  	</div><!-- row -->
  </header><!-- header -->

	<div id="main-container" class="container">
  <!-- End Custom Header Markup -->