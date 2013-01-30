<?php get_header(); ?>
			
	  <!-- Begin Custom Post Markup -->
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">

        <div id="main-content" class="content-post">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
  		  <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
  		    <?php if (has_post_thumbnail()): ?>
  		    <div id="img-vid">
    		    <?php the_post_thumbnail('lifeboat-banner'); ?>
  		    </div><!-- img-vid -->
  		    <?php endif; ?>
  		    <header>
    		    <h1 class="page-title single-title"><?php the_title(); ?></h1>
  		    </header>
  		    <div class="row">
    		    <div class="five columns">
    		      <?php if(get_field('subtitle')): ?>
      		    <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
      		    <?php endif; ?>
      		    <time datetime="2012-01-30" pubdate>January 30th, 2013</time>
      		    <div class="credits">
        		    <div class="words-by"><small>Words By </small>Alia McKee</div>
        		    <div class="art-by"><small>Illustration By </small>Jane Smith</div>
        		    <div class="views"><small>635 Views</small></div>
      		    </div>
      		    <!-- <p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p> -->
    		      <?php edit_post_link(__('Edit This Post'), '<p class="edit-links">', '</p>'); ?>
    		    </div><!-- five columns offset-by-one -->
    		    <div id="content" class="thirteen columns">
    		      <?php the_content(); ?>
    		    </div><!-- twelve columns -->
  		    </div><!-- row content -->
  		  </article><!-- content -->
  		  
  		  <?php endwhile; ?>
				<?php else: ?>
				
				<article id="post-not-found">
				    <header>
				    	<h1 class="page-title">Not Found</h1>
				    </header>
				    <section class="post-content">
				    	<p>Sorry, but the requested page was not found on this site.</p>
				    </section>
				    <footer>
				    </footer>
				</article>
				
				<?php endif; ?>
  		  
        </div><!-- content-post -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->
	  <!-- End Custom Post Markup -->

<?php get_footer(); ?>