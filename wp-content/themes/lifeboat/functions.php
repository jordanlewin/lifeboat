<?php
/*
Original Author: Eddie Machado
Author for Lifeboat: Jordan Lewin
URL: htp://digitalsparks.com
*/


/****************** INITIALIZATION & SETTINGS **************************/
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );



// Adding Translation Option
load_theme_textdomain('bonestheme', TEMPLATEPATH.'/languages');
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);

// Cleaning up the Wordpress Head
function bones_head_cleanup() {
  // remove header links
  remove_action('wp_head', 'feed_links_extra', 3 );                    // Category Feeds
  remove_action('wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
  remove_action('wp_head', 'rsd_link');                               // EditURI link
  remove_action('wp_head', 'wlwmanifest_link');                       // Windows Live Writer
  remove_action('wp_head', 'index_rel_link');                         // index link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
  remove_action('wp_head', 'start_post_rel_link', 10, 0 );             // start link
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
  remove_action('wp_head', 'wp_generator');                           // WP version
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

// Add Exerpt to Pages
add_action('init', 'lifeboat_add_excerpts_to_pages');
function lifeboat_add_excerpts_to_pages() {
     add_post_type_support('page', 'excerpt');
}

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
/*function bones_excerpt_more($more) {
 global $post;
 // edit here if you like
 return '...  <a href="'. get_permalink($post->ID) . '" class="more-link button nice radius" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'bones_excerpt_more');*/
  
// Adding WP 3+ Functions & Theme Support
function lifeboat_theme_support() {
  add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
  set_post_thumbnail_size(450, 200, true);   // default thumb size
  add_theme_support('automatic-feed-links'); // rss thingy
  add_theme_support('menus');            // wp menus
  register_nav_menus(                      // wp3+ menus
    array( 
      'primary_nav' => 'Primary Nav Menu',   // main nav in header
      'footer_links' => 'Footer Links' // secondary nav in footer
    )
  );  
  // adding post format support
  /*add_theme_support('post-formats',      // post formats
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
  );*/
}
// launching this stuff after theme setup
add_action('after_setup_theme','lifeboat_theme_support'); 
// adding sidebars to Wordpress (these are created in functions.php)
add_action('widgets_init', 'lifeboat_register_sidebars');
// adding the bones search form (created in functions.php)
add_filter('get_search_form', 'bones_wpsearch');
  

/****************** NAVIGATION **************************/
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
      'link_before' => '<div class="link-inner">',                            // before each link
      'link_after' => '</div><div class="link-btm"></div>',                             // after each link
      'depth' => 1//,                                   // limit the depth of the nav
      //'walker' => new description_walker()
    )
  );
}

function lifeboat_mobile_primary_nav() {
  wp_nav_menu( 
    array( 
      'container' => false, // remove nav container
      'container_class' => 'menu clearfix', // class of container (should you choose to use it)
      'menu' => 'primary_nav', /* menu name */
      'menu_class' => 'mobile-primary-nav',
      'theme_location' => 'primary_nav', /* where in the theme it's assigned */
      'fallback_cb' => 'lifeboat_primary_nav_fallback', /* menu fallback */
      'before' => '',                                 // before the menu
      'after' => '',                                  // after the menu
      'link_before' => '',                            // before each link
      'link_after' => '',                             // after each link
      'depth' => 1//,                                   // limit the depth of the nav
      //'walker' => new description_walker()
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
  //wp_page_menu('show_home=Home&menu_class=menu'); 
}

// this is the fallback for footer menu
function bones_footer_links_fallback() { 
  /* you can put a default here if you like */ 
}

// change the standard class that wordpress puts on the active menu item in the nav bar
//Deletes all CSS classes and id's, except for those listed in the array below
function custom_wp_nav_menu($var) {
        return is_array($var) ? array_intersect($var, array(
                //List of allowed menu classes
                'current-menu-item',
                'current-menu-parent',
                'current-page-item',
                'current-page-parent',
                'current-page-ancestor',
                'current_menu_item',
                'current_menu_parent',
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
                'current-menu-item' => 'active',
                'current-menu-parent' => 'active',
                'current-menu-ancestor' => 'active',
                'current-page-item' => 'active',
                'current-page-parent' => 'active',
                'current-page-ancestor' => 'active',
                'current_menu_item' => 'active',
                'current_menu_parent' => 'active',
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active'
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
            
            $class_names .= join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item ) );
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
            $item_output .= $args->link_before .apply_filters('the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            // if the item has children add the caret just before closing the anchor tag
            if ( $args->has_children ) {
                $item_output .= '</a><a href="#" class="flyout-toggle"><span> </span></a>';
            }
            else{
                $item_output .= '</a>';
            }
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args );
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
            
            $class_names .= join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="'. esc_attr( $class_names ) . '"';
           
            $output .= $indent . '<li ' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters('the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args );
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


if (!function_exists('get_post_top_ancestor_id')) {
  /**
   * Gets the id of the topmost ancestor of the current page. Returns the current
   * page's id if there is no parent.
   * 
   * @uses object $post
   * @return int 
   */
  function get_post_top_ancestor_id() {
    global $post;
    
    if($post->post_parent){
      $ancestors = array_reverse(get_post_ancestors($post->ID));
      return $ancestors[0];
    }
    
    return $post->ID;
  }
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


// Shortcodes
require_once('library/shortcodes.php');


/************* THUMBNAIL / IMAGE OPTIONS *************/

// Custom image sizes — in addition to defaults: Thumbnail 450x200, Medium 1086x1086, Large 1520x1520
add_image_size('lifeboat-banner', 1520, 650, true);
add_image_size('lifeboat-index', 800, 500, true);

// Remove height/width attributes on images so they can be responsive
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);

function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function lifeboat_register_sidebars() {
    register_sidebar(array(
      'id' => 'sidebar',
      'name' => 'Main Sidebar',
      'description' => 'Standard sidebar for Lifeboat.',
      'before_widget' => '<aside id="widget-%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>',
    ));
}

/************* ENQUEUE CSS AND JS *****************/

function theme_styles() { 
    // Bring in Solano Bold from Webtype
    wp_register_style('solano', '//cloud.webtype.com/css/0c68a5d2-a06b-43a5-bf13-ab12a641ce5a.css');
    // This is the compiled css file from SCSS
    wp_register_style('foundation-app', get_template_directory_uri() . '/stylesheets/app.css', array(), '3.0', 'all');
    
    wp_enqueue_style('solano');
    wp_enqueue_style('foundation-app');
}

add_action('wp_enqueue_scripts', 'theme_styles');

/************* ENQUEUE JS *************************/

/* pull jquery from google's CDN. If it's not available, grab the local copy. Code from wp.tutsplus.com :-) */
$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'; // the URL to check against  
$test_url = @fopen($url,'r'); // test parameters  
if( $test_url !== false ) { // test if the URL exists  
    function load_external_jQuery() { // load external file  
        wp_deregister_script('jquery'); // deregisters the default WordPress jQuery  
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', 'jQuery', '1.8.1'); // register the external file  
        wp_enqueue_script('jquery'); // enqueue the external file  
    }  
    add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function  
} else {  
    function load_local_jQuery() {  
        wp_deregister_script('jquery'); // initiate the function  
        wp_register_script('jquery', get_template_directory_uri() . '/javascripts/foundation/jquery.js', 'jQuery', '1.8.1'); // register the local file  
        wp_enqueue_script('jquery'); // enqueue the local file  
    }  
    add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function  
}  

/* load modernizr from foundation */
function modernize_it(){
    wp_register_script('modernizr', get_template_directory_uri() . '/javascripts/foundation/modernizr.foundation.js');
    wp_enqueue_script('modernizr');
}
add_action('wp_enqueue_scripts', 'modernize_it');

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
    wp_register_script('foundation-tabs', get_template_directory_uri() . '/javascripts/foundation/jquery.foundation.tabs.js', 'jQuery', '1.0', true);
    wp_enqueue_script('foundation-tabs');
    wp_register_script('foundation-app', get_template_directory_uri() . '/javascripts/foundation/app.js', 'jQuery', '1.0', true);
    wp_enqueue_script('foundation-app');
    wp_register_script('foundation-off-canvas', get_template_directory_uri() . '/javascripts/foundation/jquery.offcanvas.js', 'jQuery', '1.0', true);
    wp_enqueue_script('foundation-off-canvas');
}
add_action('wp_enqueue_scripts', 'foundation_js');

function lifeboat_js(){
    wp_register_script('formassembly-wforms', 'http://www.tfaforms.com/wForms/3.5/js/wforms.js');
    wp_enqueue_script('formassembly-wforms');
    wp_register_script('formassembly-wforms-prefill', 'http://www.tfaforms.com/wForms/3.5/js/wforms_prefill.js');
    wp_enqueue_script('formassembly-wforms-prefill');
    wp_register_script('forms-validation', get_template_directory_uri() . '/javascripts/validation.js', 'jQuery');
    wp_enqueue_script('forms-validation');
    wp_register_script('googlecampaign', get_template_directory_uri() . '/javascripts/googlecampaign.js');
    wp_enqueue_script('googlecampaign');
    wp_register_script('salytics', get_template_directory_uri() . '/javascripts/salytics.js', 'jQuery');
    wp_enqueue_script('salytics');
    wp_register_script('lifeboat-custom-js', get_template_directory_uri() . '/javascripts/app.js', 'jQuery', '1.0', true);
    wp_enqueue_script('lifeboat-custom-js');
    wp_register_script('retina-js', get_template_directory_uri() . '/javascripts/retina.js', false, '0.0.2', true);
    wp_enqueue_script('retina-js');
}
add_action('wp_enqueue_scripts', 'lifeboat_js');


/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/****************** password protected post form *****/

add_filter('the_password_form', 'custom_password_form');
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


?>