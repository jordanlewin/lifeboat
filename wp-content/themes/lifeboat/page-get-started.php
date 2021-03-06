<?php get_header(); ?>
			
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">
  		  
  		  <?php get_template_part( 'nav', 'secondary' ); ?>
  		  
        <div id="main-content" class="content-page getting-started-guide">

  				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  				
    		  <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
    		    <header>
      		    <h1 class="page-title"><?php the_title(); ?></h1>
    		    </header>
    		    <section class="row">
      		    <div class="six columns">
      		      <?php if(get_field('subtitle')): ?>
        		    <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
        		    <?php endif; ?>
      		      <?php the_excerpt(); ?>
      		    </div><!-- nine columns -->
      		    <div id="content" class="twelve columns">
      		      <?php the_content(); ?>
      		    </div><!-- nine columns -->
    		    </section><!-- row content -->
  
            <?php
              $args = array(
                'post_type' => 'practice',
              	'orderby'    => 'menu_order',
              	'order'    => 'ASC'
              );
              $practices_thumbs_query = new WP_Query($args);
              $c = 1;
              if ($practices_thumbs_query->have_posts()) : ?>
    		    <section id="practice-thumbs-grid">
      		    <h4 class="label-title">Lifeboat Practices</h4>
              <ul class="block-grid three-up mobile-two-up">
      				  <?php while ($practices_thumbs_query->have_posts()) : $practices_thumbs_query->the_post(); ?>
                <li class="practice-thumb">
                  <a href="#practice-<?php print $c; ?>">
                    <h2><?php the_title(); ?></h2>
                    <?php //the_excerpt(); ?>
            		    <?php if (has_post_thumbnail()): ?>
            		    <div class="practice-thumb-image">
              		    <?php the_post_thumbnail('thumbnail'); ?>
            		    </div><!-- practice-thumb -->
            		    <?php endif; ?>
                  </a>
                </li>
                <?php $c++; endwhile; wp_reset_query(); ?>
              </ul><!-- block-grid -->
            </section><!-- practice-thumbs-grid -->
            <?php endif; ?>
  
    		  </article><!-- type-page -->
  
  		    <div class="practice-bottom"></div>
    		  
    		  <?php endwhile; ?>
  				
          <?php
            $args = array(
              'post_type' => 'practice',
            	'orderby'    => 'menu_order',
            	'order'    => 'ASC'
            );
            $practices_query = new WP_Query($args);
            $c = 1;
            if ($practices_query->have_posts()) : ?>
  				<section id="lifeboat-practices">
  				  <?php while ($practices_query->have_posts()) : $practices_query->the_post(); ?>
            <article id="practice-<?php print $c; ?>" class="practice">
      		    <?php if (has_post_thumbnail()): ?>
    		      <div class="practice-top">
    		        <div class="practice-num"><span><?php print $c; ?></span></div>
    		      </div><!-- practice-top -->
      		    <div class="practice-banner">
        		    <?php the_post_thumbnail('lifeboat-banner'); ?>
      		    </div><!-- practice-banner -->
      		    <?php endif; ?>
      		    <div class="practice-content content">
        		    <header>
                  <h2 class="practice-title"><span><?php the_title(); ?></span></h2>
        		    </header>
        		    <section class="content-inner">
                  <?php the_content(); ?>
        		    </section><!-- practice-content -->
      		    </div><!-- practice-content -->
            </article><!-- practice -->
    		    <div class="practice-bottom"></div>
            <?php $c++; endwhile; wp_reset_postdata(); ?>
          </section><!-- lifeboat-practices -->
          <?php endif; ?>
          
          <?php get_template_part('references'); ?>
  
  				<?php else: ?>
  				
  				<?php get_template_part('post-not-found'); ?>
  				
  				<?php endif; ?>
 		  
        </div><!-- content-page -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->

<?php get_footer(); ?>