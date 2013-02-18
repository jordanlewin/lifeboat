<?php
/*
Template Name: Overview Page
*/
?>

<?php get_header(); ?>
			
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">

  		  <?php get_template_part( 'nav', 'secondary' ); ?>
  		  
        <div id="main-content" class="content-page template-overview">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
  		  <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
  		    <?php if (has_post_thumbnail()): ?>
  		    <div id="img-vid">
    		    <?php the_post_thumbnail('lifeboat-banner'); ?>
  		    </div><!-- img-vid -->
  		    <?php endif; ?>
  		    <header>
    		    <h1 class="page-title"><?php the_title(); ?></h1>
  		    </header>
  		    <?php if (get_the_content() || get_field('subtitle')) : ?>
  		    <section id="content"<?php if (get_the_content()) { print 'class="with-content"'; } ?>>
  		      <?php if(get_field('subtitle')): ?>
    		    <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
    		    <?php endif; ?>
  		      <?php the_content(); ?>
  		    </section><!-- content -->
  		    <?php endif; ?>
  		  </article><!-- type-page -->
  		  
  		  <?php endwhile; ?>

        <?php //global $query_string;
          $args = array(
            'post_type' => 'page',
          	'post_parent'=> get_the_ID(),
          	'orderby'    => 'menu_order',
          	'order'    => 'ASC'
          );
          query_posts($args);
          $c = 0;
          if (have_posts()) : ?>
				<section id="overview-grid">
          <ul class="block-grid two-up mobile">
            <?php while (have_posts()) : the_post(); ?>
            <li class="<?php echo $c++&1 ? 'even' : 'odd'; ?>">
              <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
              </a>
            </li>
            <?php endwhile; wp_reset_query(); ?>
          </ul><!-- block-grid -->
        </section><!-- overview-grid -->
        <?php endif; ?>

        <?php get_template_part('references'); ?>
 		  
				<?php else: ?>
				
				<?php get_template_part('post-not-found'); ?>
				
				<?php endif; ?>
				
        </div><!-- main-content content-page -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->

<?php get_footer(); ?>