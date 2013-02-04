<?php get_header(); ?>
			
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">

        <div id="main-content" class="content-post">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
  		  <article id="page-<?php the_ID(); ?>" <?php post_class('post-single clearfix'); ?> role="article">
  		    <?php if (has_post_thumbnail()): ?>
  		    <div id="img-vid">
    		    <?php the_post_thumbnail('lifeboat-banner'); ?>
  		    </div><!-- img-vid -->
  		    <?php endif; ?>
  		    <header>
    		    <h1 class="page-title single-title"><?php the_title(); ?></h1>
  		    </header>
  		    <section class="row">
    		    <div class="five columns">
    		      <?php if(get_field('subtitle')): ?>
      		    <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
      		    <?php endif; ?>
      		    <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
      		    <div class="credits">
        		    <div class="words-by"><small>Words By </small><?php the_author_posts_link(); ?></div>
        		    <!-- <div class="art-by"><small>Illustration By </small>Jane Smith</div>
        		    <div class="views"><small>635 Views</small></div> -->
      		    </div><!-- credits -->
      		    <?php get_template_part( 'share-icons', 'inside' ); ?>
    		    </div><!-- five columns -->
    		    <div id="content" class="thirteen columns">
    		      <?php the_content(); ?>
    		    </div><!-- twelve columns -->
  		    </section><!-- row content -->
  		    <footer>
  		      <?php if (get_the_category()) : ?>
    		    <div class="categories">
    		      <h4 class="label-title">Posted In:</h4>
    		      <?php the_category(); ?>
    		    </div><!-- categories -->
    		    <?php endif; ?>
    		    <div id="share-bottom">
    		      <h3>Already shared this? No? Share it now:</h3>
    		      <p class="panel buttons">Facebook and Twitter Share Buttons Here</p>
    		    </div><!-- share-bottom -->
    		    <div id="comments">
    		      <h2>What do you think?</h2>
    		      <p class="panel">Disqus Comments Here</p>
    		    </div><!-- comments -->
  		    </footer>
  		  </article><!-- content -->
  		  
  		  <?php endwhile; ?>
				<?php else: ?>
				
				<article id="post-not-found">
				    <header>
				    	<h1 class="page-title">Not Found</h1>
				    </header>
				    <section class="content">
				    	<p>Sorry, but the requested page was not found.</p>
				    </section>
				    <footer>
				    </footer>
				</article>
				
				<?php endif; ?>
  		  
        </div><!-- content-post -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->

<?php get_footer(); ?>