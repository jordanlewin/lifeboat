<?php get_header(); ?>
			
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">

        <div id="main-content" class="content-post">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
  		  <article id="page-<?php the_ID(); ?>" <?php post_class('post-single clearfix'); ?> role="article">
  		    <header>
    		    <?php if (has_post_thumbnail()): ?>
    		    <div id="img-vid">
      		    <?php the_post_thumbnail('lifeboat-banner'); ?>
    		    </div><!-- img-vid -->
    		    <?php endif; ?>
    		    <h1 class="page-title"><?php the_title(); ?></h1>
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
      		    <?php get_template_part('share-icons'); ?>
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
    		      <div class="share-bottom-buttons">
                <span class="button st_facebook_custom" displayText="">
                  <span class="icon" aria-hidden="true" data-icon="&#xe016;"></span>
                  <span class="button-text">Facebook</span>
                </span>
                <span class="button st_twitter_custom" displayText="">
                  <span class="icon" aria-hidden="true" data-icon="&#xe018;"></span>
                  <span class="button-text">Twitter</span>
                </span>
    		      </div><!-- share-bottom-buttons -->
            </div><!-- share-bottom -->
    		    <div id="comments">
    		      <h2>What do you think?</h2>
    		      <div class="disqus-comments">
      		      <?php comments_template(); ?>
    		      </div><!-- disqus-comments -->
    		    </div><!-- comments -->
  		    </footer>
  		  </article><!-- content -->
  		  
  		  <?php endwhile; ?>
				<?php else: ?>
				
				<?php get_template_part('post-not-found'); ?>
				
				<?php endif; ?>
  		  
        </div><!-- content-post -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->

<?php get_footer(); ?>