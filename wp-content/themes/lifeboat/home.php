<?php get_header(); ?>
      
    <!-- Begin Custom Blog Index Markup -->
    <div class="row">
      <section id="main" class="thirteen columns offset-by-one push-four">
        <div id="content" class="content-blog">
          
  		    <header>
    		    <h1 class="page-title blog-title">The Friend Blog</h1>
  		    </header>

          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          
          <article <?php post_class('blog-post'); ?> role="article">
            <a href="<?php the_permalink(); ?>" class="blog-post-link">
              <div class="post-image">
                <?php the_post_thumbnail('featured-index'); ?>
              </div><!-- post-image -->
              <div class="post-content">
                <h2><?php the_title(); ?></h2>
                <?php if(get_field('subtitle')): ?>
                <h4 class="subtitle"><?php the_field('subtitle'); ?></h4>
                <?php endif; ?>
              </div><!-- post-content -->
            </a><!-- blog-post-link -->
          </article><!-- blog-post -->

          <?php endwhile; ?>
          <?php else: ?>
          
          <article id="post-not-found">
              <header>
                <h1 class="page-title">Not Found</h1>
              </header>
              <section class="post-content">
                <p>Sorry, but the requested post was not found on this site.</p>
              </section>
              <footer>
              </footer>
          </article>
          
          <?php endif; ?>

        </div><!-- content -->
      </section><!-- main -->
    
      <?php get_sidebar(); ?>
    
    </div><!-- row -->
    <!-- End Custom Blog Index Markup -->

<?php get_footer(); ?>