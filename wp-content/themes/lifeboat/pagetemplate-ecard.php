<?php
/*
Template Name: Ecard
*/
?>

<?php get_header(); ?>
      
    <div class="row">
      <section id="main" class="thirteen columns offset-by-one push-four">

        <?php get_template_part( 'nav', 'secondary' ); ?>
        
        <div id="main-content" class="content-page template-ecard">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article id="page-<?php the_ID(); ?>" <?php post_class('ecard clearfix'); ?> role="article">
          <header>
            <h1 class="page-title"><?php the_title(); ?></h1>
  				  <?php if (has_post_thumbnail()): ?>
  				  <div class="ecard-card">
    				  <figure class="ecard-image">
      				  <?php the_post_thumbnail('large'); ?>
    				  </figure>
    				  <div class="ecard-bottom"></div>
  				  </div><!-- ecard-card -->
  				  <?php endif; ?>
          </header>
          <section class="row">
            <div id="content" class="thirteen columns">
              <?php the_content(); ?>
              <?php if (!get_field("bottom_tabs")) { get_template_part('references'); } ?>
            </div><!-- twelve columns -->
            <div class="five columns">
              <div class="send-this-ecard"><a href="mailto:?subject=Because we’re friends...&body=...I thought you’d like this friend fact ecard&mdash;enjoy!%0D%0A%0D%0A<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>%0D%0A%0D%0AAnd let’s hangout soon!" class="button action with-icon content-share">Send This Ecard <span class="icon" aria-hidden="true" data-icon="&#xe002;"></span></a></div>
              <div class="view-more-ecards"><a href="/goodies/friend-fact-ecards" class="button small highlight">View More Ecards</a></div>
              <?php get_template_part('share', 'icons'); ?>
            </div><!-- five columns -->
          </section><!-- row content -->
          
          <?php if (get_field("bottom_tabs")) { get_template_part('tabs', 'bottom'); get_template_part('references'); } ?>
          
        </article><!-- type-page -->
        
        <?php endwhile; ?>
        <?php else: ?>
        
        <?php get_template_part('post-not-found'); ?>
        
        <?php endif; ?>
        
        </div><!-- content-page -->
      </section><!-- main -->
    
      <?php get_sidebar(); ?>
      
    </div><!-- row -->

<?php get_footer(); ?>