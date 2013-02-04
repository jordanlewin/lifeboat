<?php get_header(); ?>
			
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">

  		  <?php get_template_part( 'nav', 'secondary' ); ?>
  		  
        <div id="main-content" class="content-page">

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
  		    <section class="row">
    		    <div id="content" class="thirteen columns">
    		      <?php if(get_field('subtitle')): ?>
      		    <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
      		    <?php endif; ?>
    		      <?php the_content(); ?>
    		    </div><!-- twelve columns -->
    		    <div class="five columns">
    		      <!-- <p class="panel">Share Icons Here</p> -->
    		      <?php get_template_part( 'share-icons', 'inside' ); ?>
    		    </div><!-- five columns offset-by-one -->
  		    </section><!-- row content -->
  		  </article><!-- type-page -->
  		  
  		  <?php endwhile; ?>
				<?php else: ?>
				
				<article id="post-not-found">
				    <header>
				    	<h1 class="page-title">Not Found</h1>
				    </header>
				    <section class="post-content">
				    	<p>Sorry, but the requested page was not found.</p>
				    </section>
				    <footer>
				    </footer>
				</article>
				
				<?php endif; ?>
  		  
        </div><!-- content-page -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->

<?php get_footer(); ?>