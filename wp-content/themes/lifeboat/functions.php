<?php
/*
Original Author: Eddie Machado
Author for Lifeboat: Jordan Lewin
URL: htp://digitalsparks.com
*/

// Get Bones Core Up & Running!
//require_once('library/bones.php'); // core functions // JL: Pasted contents of bones.php into functions.php to customize directly here

// Adding Translation Option
load_theme_textdomain( 'bonestheme', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

// Cleaning up the Wordpress Head
function bones_head_cleanup() {
	// remove header links
	remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
	if (!is_admin()) {
		wp_deregister_script('jquery');                                   // De-Register jQuery
		wp_register_script('jquery', '', '', '', true);                   // It's already in the Header
	}	
}
	// launching operation cleanup
	add_action('init', 'bones_head_cleanup');
	// remove WP version from RSS
	function bones_rss_version() { return ''; }
	add_filter('the_generator', 'bones_rss_version');
	
// loading jquery reply elements on single pages automatically
function bones_queue_js(){ if (!is_admin()){ if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script( 'comment-reply' ); }
}
	// reply on comments script
	add_action('wp_print_scripts', 'bones_queue_js');

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
// function bones_excerpt_more($more) {
// 	global $post;
// 	// edit here if you like
// 	return '...  <a href="'. get_permalink($post->ID) . '" class="more-link button nice radius" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
// }
// add_filter('excerpt_more', 'bones_excerpt_more');
	
// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {
	add_theme_support( 'post-thumbnails' );      // wp thumbnails (sizes handled in functions.php)
	set_post_thumbnail_size( 300, 300, true );   // default thumb size
	//add_theme_support( 'custom-background' );   // wp custom background
	add_theme_support( 'automatic-feed-links' ); // rss thingy
	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
	// adding post format support
	/*add_theme_support( 'post-formats',      // post formats
		array( 
			'aside',   // title less blurb
			'gallery', // gallery of images
			'link',    // quick link to other site
			'image',   // an image
			'quote',   // a quick quote
			'status',  // a Facebook like status update
			'video',   // video 
			'audio',   // audio
			'chat'     // chat transcript 
		)
	);	*/
	add_theme_support( 'menus' );            // wp menus
	register_nav_menus(                      // wp3+ menus
		array( 
			'primary_nav' => 'Primary Nav Menu',   // main nav in header
			//'secondary_nav' => 'Secondary Nav Menu',   // sub nav in content area
			'footer_links' => 'Footer Links' // secondary nav in footer
		)
	);	
}

// launching this stuff after theme setup
add_action('after_setup_theme','bones_theme_support');	
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'bones_register_sidebars' );
// adding the bones search form (created in functions.php)
add_filter( 'get_search_form', 'bones_wpsearch' );
	
function lifeboat_primary_nav() {
	// display the wp3 menu if available
  wp_nav_menu( 
  	array( 
      'container' => false, // remove nav container
    	'container_class' => 'menu clearfix', // class of container (should you choose to use it)
  		'menu' => 'primary_nav', /* menu name */
  		'menu_class' => 'primary-nav',
  		'theme_location' => 'primary_nav', /* where in the theme it's assigned */
  		'fallback_cb' => 'lifeboat_primary_nav_fallback', /* menu fallback */
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 1,                                   // limit the depth of the nav
  		'walker' => new description_walker()
  	)
  );
}

/* JL Experiment to create subnavigation based on Primary Nav Menu */
function lifeboat_sub_nav() {
	// display the wp3 menu if available
  wp_nav_menu( 
  	array( 
      'container' => false, // remove nav container
    	'container_class' => 'menu clearfix', // class of container (should you choose to use it)
  		'menu' => 'primary_nav', /* menu name */
  		'menu_class' => 'secondary-nav',
  		'theme_location' => 'primary_nav', /* where in the theme it's assigned */
  		'fallback_cb' => 'lifeboat_primary_nav_fallback', /* menu fallback */
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
  		'walker' => new description_walker()
  	)
  );
}


function bones_mobile_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'menu' => 'mobile_nav', /* menu name */
    		'menu_class' => 'side-nav tabs vertical',
    		'theme_location' => 'primary_nav', /* where in the theme it's assigned */
    		'container_class' => 'mobile-nav-container', /* container tag */
    		'fallback_cb' => 'lifeboat_primary_nav_fallback', /* menu fallback */
    		'depth' => '1'
    	)
    );
}

function bones_footer_links() { 
	// display the wp3 menu if available
    wp_nav_menu(
    	array(
    		'menu' => 'footer_links', /* menu name */
    		'menu_class' => 'link-list',
    		'theme_location' => 'footer_links', /* where in the theme it's assigned */
    		'container_class' => 'footer-links clearfix', /* container class */
    		'fallback_cb' => 'bones_footer_links_fallback', /* menu fallback */
    		'walker' => new footer_links_walker()
    	)
	);
}
 
// this is the fallback for header menu
function lifeboat_primary_nav_fallback() { 
	// not calling this in case of multiple level pages - hope to add dropdown menu as an enhancement
	//wp_page_menu( 'show_home=Home&menu_class=menu' ); 
}

// this is the fallback for footer menu
function bones_footer_links_fallback() { 
	/* you can put a default here if you like */ 
}


/****************** PLUGINS & EXTRA FEATURES **************************/
	
// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if($tags) {
		foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
        	'tag' => $tag_arr,
        	'numberposts' => 5, /* you can change this to show more */
        	'post__not_in' => array($post->ID)
     	);
        $related_posts = get_posts($args);
        if($related_posts) {
        	foreach ($related_posts as $post) : setup_postdata($post); ?>
	           	<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
	        <?php endforeach; } 
	    else { ?>
            <li class="no_related_post">No Related Posts Yet!</li>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
}

// Numeric Page Navi (built into the theme by default)
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<ul class="pagination clearfix">'."";
	if ($paged > 1) {
		$first_page_text = "&laquo";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}
		
	echo '<li class="">';
	previous_posts_link('&larr; Previous');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="current"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next &rarr;');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "&raquo;";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul>'.$after."";
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


/*
End of import of bones.php and beginning of functions.php
This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

//require_once('library/plugins.php');        // plugins & extra functions (optional)
//require_once('library/custom-post-type.php'); // custom post type example

// Options panel
//require_once('library/options-panel.php'); // removed by Jordan Lewin 1/16/12

// Shortcodes
require_once('library/shortcodes.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
function bones_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://320press.com" target="_blank">320press</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'bones_custom_admin_footer');

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'featured', 1520, 652, true );
add_image_size ( 'featured-index', 800, 500, true );
//add_image_size( 'bones-thumb-600', 600, 150, false );
//add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar',
    	'name' => 'Main Sidebar',
    	'description' => 'Standard sidebar for Lifeboat.',
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h4 class="widget-title">',
    	'after_title' => '</h4>',
    ));
    
    /*register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Homepage Sidebar',
    	'description' => 'Used only on the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));*/
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* ENQUEUE CSS AND JS *****************/

function theme_styles()  
{ 
    // Bring in Solano Bold from Webtype
    wp_register_style( 'solano', '//cloud.webtype.com/css/0c68a5d2-a06b-43a5-bf13-ab12a641ce5a.css');
    // This is the compiled css file from SCSS
    wp_register_style( 'foundation-app', get_template_directory_uri() . '/stylesheets/app.css', array(), '3.0', 'all' );
    
    wp_enqueue_style( 'solano' );
    wp_enqueue_style( 'foundation-app' );
}

add_action('wp_enqueue_scripts', 'theme_styles');

/************* ENQUEUE JS *************************/

/* pull jquery from google's CDN. If it's not available, grab the local copy. Code from wp.tutsplus.com :-) */

$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'; // the URL to check against  
$test_url = @fopen($url,'r'); // test parameters  
if( $test_url !== false ) { // test if the URL exists  

    function load_external_jQuery() { // load external file  
        wp_deregister_script('jquery'); // deregisters the default WordPress jQuery  
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', 'jQuery', '1.8.1', true); // register the external file  
        wp_enqueue_script('jquery'); // enqueue the external file  
    }  

    add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function  
} else {  

    function load_local_jQuery() {  
        wp_deregister_script('jquery'); // initiate the function  
        wp_register_script('jquery', get_template_directory_uri() . '/javascripts/foundation/jquery.js', 'jQuery', '1.8.1', true); // register the local file  
        wp_enqueue_script('jquery'); // enqueue the local file  
    }  

    add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function  
}  

/* load modernizr from foundation */
function modernize_it(){
    wp_register_script('modernizr', get_template_directory_uri() . '/javascripts/foundation/modernizr.foundation.js'); 
    wp_enqueue_script('modernizr');
}

add_action( 'wp_enqueue_scripts', 'modernize_it');

function foundation_js(){
    wp_register_script('foundation-reveal', get_template_directory_uri() . '/javascripts/foundation/jquery.foundation.reveal.js', 'jQuery', '1.1', true);
    wp_enqueue_script('foundation-reveal');
    wp_register_script('foundation-orbit', get_template_directory_uri() . '/javascripts/foundation/jquery.foundation.orbit.js', 'jQuery', '1.4.0', true);
    wp_enqueue_script('foundation-orbit');
    wp_register_script('foundation-custom-forms', get_template_directory_uri() . '/javascripts/foundation/jquery.foundation.forms.js', 'jQuery', '1.0', true);
    wp_enqueue_script('foundation-custom-forms');
    wp_register_script('foundation-placeholder', get_template_directory_uri() . '/javascripts/foundation/jquery.placeholder.js', 'jQuery', '2.0.7', true);
    wp_enqueue_script('foundation-placeholder');
    wp_register_script('foundation-tooltips', get_template_directory_uri() . '/javascripts/foundation/jquery.foundation.tooltips.js', 'jQuery', '2.0.2', true);
    wp_enqueue_script('foundation-tooltips');
    wp_register_script('foundation-app', get_template_directory_uri() . '/javascripts/foundation/app.js', 'jQuery', '1.0', true);
    wp_enqueue_script('foundation-app');
    wp_register_script('foundation-off-canvas', get_template_directory_uri() . '/javascripts/foundation/jquery.offcanvas.js', 'jQuery', '1.0', true);
    wp_enqueue_script('foundation-off-canvas');
}

add_action('wp_enqueue_scripts', 'foundation_js');

function lifeboat_js(){
    //wp_register_script('wp-foundation-js', get_template_directory_uri() . '/library/js/scripts.js', 'jQuery', '1.0', true); // JL: Removed because I moved these scripts all into app-custom.js
    //wp_enqueue_script('wp-foundation-js');
    wp_register_script('lifeboat-custom-js', get_template_directory_uri() . '/javascripts/app-custom.js', 'jQuery', '1.0', true); // JL: This file includes custom JS from Bones, WP Foundation, and Lifeboat
    wp_enqueue_script('lifeboat-custom-js');
}

add_action('wp_enqueue_scripts', 'lifeboat_js');

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="panel clearfix">
			<div class="comment-author vcard row clearfix">
                <div class="twelve columns">
                    <div class="
                        <?php
                        $authID = get_the_author_meta('ID');
                                                    
                        if($authID == $comment->user_id)
                            echo "panel callout";
                        else
                            echo "panel";
                        ?>
                    ">
                        <div class="row">
            				<div class="avatar two columns">
            					<?php echo get_avatar($comment,$size='75',$default='<path_to_url>'); ?>
            				</div>
            				<div class="ten columns">
            					<?php printf(__('<h4 class="span8">%s</h4>'), get_comment_author_link()) ?>
            					<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
            					
            					<?php edit_comment_link(__('Edit'),'<span class="edit-comment">', '</span>'); ?>
                                
                                <?php if ($comment->comment_approved == '0') : ?>
                   					<div class="alert-box success">
                      					<?php _e('Your comment is awaiting moderation.') ?>
                      				</div>
            					<?php endif; ?>
                                
                                <?php comment_text() ?>
                                
                                <!-- removing reply link on each comment since we're not nesting them -->
            					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Add grid classes to comments
function add_class_comments($classes){
    array_push($classes, "twelve", "columns");
    return $classes;
}
add_filter('comment_class', 'add_class_comments');

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form action="' . get_option('siteurl') . '/wp-pass.php" method="post">
	' . __( "<p>This post is password protected. To view it please enter your password below:</p>" ) . '
	<div class="row collapse">
        <div class="twelve columns"><label for="' . $label . '">' . __( "Password:" ) . ' </label></div>
        <div class="eight columns">
            <input name="post_password" id="' . $label . '" type="password" size="20" class="input-text" />
        </div>
        <div class="four columns">
            <input type="submit" name="Submit" class="postfix button nice blue radius" value="' . esc_attr__( "Submit" ) . '" />
        </div>
	</div>
    </form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
        foreach( $tags as $tag ) {
            $tagn[] = preg_replace($regex, "('$1$2 label radius tag-'.get_tag($2)->slug.'$3')", $tag );
        }
    $taglinks = implode('</a>', $tagn);
    return $taglinks;
}

add_action('wp_tag_cloud', 'add_tag_class');

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);

function wp_tag_cloud_filter($return, $args)
{
  return '<div id="tag-cloud"><p>'.$return.'</p></div>';
}

function add_class_the_tags($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="label success radius"',$html);
    return $html;
}
add_filter('the_tags','add_class_the_tags',10,1);

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Disable jump in 'read more' link
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// change the standard class that wordpress puts on the active menu item in the nav bar
//Deletes all CSS classes and id's, except for those listed in the array below
function custom_wp_nav_menu($var) {
        return is_array($var) ? array_intersect($var, array(
                //List of allowed menu classes
                'current_page_item',
                'current_page_parent',
                'current_page_ancestor',
                'first',
                'last',
                'vertical',
                'horizontal'
                )
        ) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');
 
//Replaces "current-menu-item" with "active"
function current_to_active($text){
        $replace = array(
                //List of menu item classes that should be changed to "active"
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','current_to_active');
 
//Deletes empty classes and removes the sub menu class
function strip_empty_classes($menu) {
    $menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','strip_empty_classes');


// add the 'has-flyout' class to any li's that have children and add the arrows to li's with children

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $class_names = $value = '';
            
            // If the item has children, add the dropdown class for foundation
            if ( $args->has_children ) {
                $class_names = "has-flyout ";
            }
            
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            
            $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="'. esc_attr( $class_names ) . '"';
           
            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            // if the item has children add these two attributes to the anchor tag
            // if ( $args->has_children ) {
            //     $attributes .= 'class="dropdown-toggle" data-toggle="dropdown"';
            // }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            // if the item has children add the caret just before closing the anchor tag
            if ( $args->has_children ) {
                $item_output .= '</a><a href="#" class="flyout-toggle"><span> </span></a>';
            }
            else{
                $item_output .= '</a>';
            }
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
            
        function start_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"flyout\">\n";
        }
            
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
            {
                $id_field = $this->db_fields['id'];
                if ( is_object( $args[0] ) ) {
                    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
                }
                return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
            }       
}

// Walker class to customize footer links
class footer_links_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $class_names = $value = '';
            
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            
            $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="'. esc_attr( $class_names ) . '"';
           
            $output .= $indent . '<li ' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
            
        function start_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"flyout\">\n";
        }
            
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
            {
                $id_field = $this->db_fields['id'];
                if ( is_object( $args[0] ) ) {
                    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
                }
                return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
            }       
}

/* Add Exerpt to Pages */
add_action( 'init', 'lifeboat_add_excerpts_to_pages' );
function lifeboat_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*
// Add Lifeboat Meta Box
function add_lifeboat_meta_box() {  
  add_meta_box(
    $id = 'lifeboat_meta_box', // $id  
    $title = 'Lifeboat Custom Fields', // $title  
    $callback = 'show_lifeboat_meta_box' // $callback  
    //'post', // $page  
    //$context = 'normal', // $context
    //$priority = 'high' // $priority
  ); 
}  
add_action('add_meta_boxes', 'add_lifeboat_meta_box');

// Field Array: Subtitle, ...
//$prefix = 'custom_';  
$custom_meta_fields = array(
  array(
    'label' => 'Subtitle',
    'desc'  => 'Used on Pages, Posts, and Landing Pages to display orange subtitle.',
    'id'    => 'subtitle',
    'type'  => 'textarea'
  )
);

// The Lifeboat Meta Box Callback  
function show_lifeboat_meta_box() {  
  global $custom_meta_fields, $post;
  // Use nonce for verification  
  echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  

  // Begin the field table and loop  
  echo '<table class="form-table">';  
  foreach ($custom_meta_fields as $field) {  
      // get value of this field if it exists for this post  
      $meta = get_post_meta($post->ID, $field['id'], true);  
      // begin a table row with  
      echo '<tr> 
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
              <td>';  
              switch($field['type']) {  
                  // text  
                  case 'text':  
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;
                  
                  // textarea  
                  case 'textarea':  
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;  
              } //end switch  
      echo '</td></tr>';  
  } // end foreach  
  echo '</table>'; // end table  
}  

// Save the Data  
function save_lifeboat_meta($post_id) {  
    global $custom_meta_fields;  
  
    // verify nonce  
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))  
        return $post_id;  
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  
    // loop through fields and save the data  
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_lifeboat_meta');
*/

?>