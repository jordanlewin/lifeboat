<?php get_header(); ?>
      
    <div class="row">
      <section id="main" class="thirteen columns offset-by-one push-four">

        <?php get_template_part( 'nav', 'secondary' ); ?>
        
        <div id="main-content" class="content-page">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
          <header>
            <?php if (has_post_thumbnail()): ?>
            <div id="img-vid">
              <?php the_post_thumbnail('lifeboat-banner'); ?>
            </div><!-- img-vid -->
            <?php endif; ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
          </header>
          <section class="row">
            <div id="content" class="thirteen columns">
              <?php if(get_field('subtitle')): ?>
              <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
              <?php endif; ?>
              <?php the_content(); ?>
              <?php if (!get_field("bottom_tabs")) { get_template_part('references'); } ?>
            </div><!-- twelve columns -->
            <div class="five columns">
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