<?php get_header(); ?>
			
	  <!-- Begin Custom Page Markup -->
	  <div class="row">
  		<section id="main" class="thirteen columns offset-by-one push-four">
  		  <div class="row">
    		  <nav id="secondary" class="eighteen columns">
    		    <?php
            $subpages = ($post->post_parent) ? wp_list_pages('title_li=&child_of='.$post->post_parent.'&depth=1&echo=0') : wp_list_pages('title_li=&child_of='.$post->ID.'&depth=1&echo=0');
            if($subpages) { echo('<ul>'.$subpages.'</ul>'); }
            ?>
    		  </nav><!-- secondary -->
  		  </div><!-- row -->
  		  
        <div id="content" class="content-page">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
  		  <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
  		    <div class="row">
    		    <div class="eighteen columns">
      		    <div id="img-vid">
        		    <p class="panel">Image or Video Here</p>
      		    </div><!-- img-vid -->
      		    <header>
        		    <h1 class="page-title"><?php the_title(); ?></h1>
      		    </header>
    		    </div><!-- eighteen columns -->
  		    </div><!-- row -->
  		    <div class="row content">
    		    <div class="twelve columns">
    		      <?php if(get_field('subtitle')): ?>
      		    <h4 class="subtitle"><?php the_field('subtitle'); ?></h4>
      		    <?php endif; ?>
    		      <?php the_content(); ?>
    		    </div><!-- twelve columns -->
    		    <div class="five columns offset-by-one">
    		      <p class="panel">Share Icons Here</p>
    		      <?php edit_post_link(__('Edit This Page'), '<p class="edit-links">', '</p>'); ?>
    		    </div><!-- five columns offset-by-one -->
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
  		  
        </div><!-- content-page -->
  		</section><!-- main -->
  	
  		<?php get_sidebar(); ?>
  		
	  </div><!-- row -->
	  <!-- End Custom Page Markup -->

<?php get_footer(); ?>