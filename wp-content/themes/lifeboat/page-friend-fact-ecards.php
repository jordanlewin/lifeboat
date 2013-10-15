<?php get_header(); ?>
			
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">
  		  
  		  <?php get_template_part( 'nav', 'secondary' ); ?>
  		  
        <div id="main-content" class="content-page friend-fact-ecards">
  
  				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  				
    		  <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
    		    <header>
      		    <h1 class="page-title"><?php the_title(); ?></h1>
    		    </header>
            <section id="content">
              <?php if(get_field('subtitle')): ?>
              <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
              <?php endif; ?>
              <?php the_content(); ?>
            </section><!-- content -->
    		  </article><!-- type-page -->
    		  
    		  <?php endwhile; ?>
    		  
          <?php //global $query_string;
            $args = array(
              'post_type' => 'page',
            	'post_parent'=> get_the_ID(),
            	'orderby'    => 'menu_order',
            	'order'    => 'ASC'
            );
            $ecards_query = new WP_Query($args);
            $c = 1;
            if ($ecards_query->have_posts()) : ?>
  				<section id="ecards">
  				  <?php while ($ecards_query->have_posts()) : $ecards_query->the_post(); ?>
  				  <article id="ecard-<?php print $c; ?>" class="ecard clearfix">
    				  <div class="row">
      				  <div class="thirteen columns">
        				  <div class="ecard-card">
        				    <a href="mailto:?subject=Because we’re friends...&body=...I thought you’d like this friend fact ecard&mdash;enjoy!%0D%0A%0D%0A<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>%0D%0A%0D%0AAnd let’s hangout soon!" class="ecard-link content-share" title="Send this Ecard to a Friend">
            				  <div class="ecard-corner-badge"></div>
            				  <figure class="ecard-image">
              				  <?php if (has_post_thumbnail()): ?>
              				  <?php the_post_thumbnail('medium'); ?>
              				  <?php endif; ?>
            				  </figure>
        				    </a>
          				  <div class="ecard-bottom"></div>
        				  </div><!-- ecard-card -->
      				  </div><!-- twelve columns -->
      				  <div class="ecard-content content five columns">
        				  <header>
          				  <h5 class="number-title">Friend Fact #<?php print $c; ?></h5>
          				  <?php if (get_the_title()) : ?><h2 class="ecard-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php endif; ?>
        				  </header>
        				  <section>
          				  <div class="ecard-excerpt">
            				  <?php the_excerpt(); ?>
          				  </div><!-- ecard-excerpt -->
          				  <p class="ecard-subtitle"><?php the_field('subtitle'); ?></p>
        				  </section>
      				  </div><!-- ecard-content -->
    				  </div><!-- row -->
  				  </article><!-- ecard -->
  				  <?php $c++; endwhile; wp_reset_postdata(); ?>
  				</section><!-- ecards -->
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