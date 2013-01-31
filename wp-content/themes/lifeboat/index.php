<?php get_header(); ?>
      
    <!-- Begin Custom Blog Index Markup -->
    <div class="row">
      <section id="main" class="thirteen columns offset-by-one push-four">
        <div id="content" class="content-index">
          
          <?php if (is_home()) : ?>
          <header>
            <h1 class="page-title blog-title">The Friend Blog</h1>
          </header>
          <?php endif; ?>

          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          
          <article <?php (has_post_thumbnail()) ? post_class('post-teaser clearfix with-image') : post_class('post-teaser clearfix'); ?> role="article">
            <a href="<?php the_permalink(); ?>" class="post-link">
              <?php if (has_post_thumbnail()) : ?>
              <div class="post-image">
                <?php the_post_thumbnail('lifeboat-index'); ?>
              </div><!-- post-image -->
              <?php endif; ?>
              <div class="post-content">
                <h2><?php the_title(); ?></h2>
                <?php if(get_field('subtitle')) : ?>
                <h4 class="subtitle"><?php the_field('subtitle'); ?></h4>
                <?php endif; ?>
                <div class="meta">
          		    <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
          		    <div class="words-by"><small>By </small><?php the_author(); ?></div>
          		    <div class="views"><small>635 Views</small></div>
                </div><!-- meta -->
              </div><!-- post-content -->
            </a><!-- blog-post-link -->
          </article><!-- blog-post -->

          <?php endwhile; ?>
          
          <?php if (function_exists('page_navi')) { // if expirimental feature is active
                  page_navi(); // use the page navi function
                } else { // if it is disabled, display regular wp prev & next links ?>
          <nav class="wp-prev-next">
            <ul class="clearfix">
              <li class="prev-link"><?php next_posts_link('&laquo; Older Entries') ?></li>
              <li class="next-link"><?php previous_posts_link('Newer Entries &raquo;') ?></li>
            </ul>
          </nav>
          <?php } ?>
          
          <?php else: ?>
          
          <article id="post-not-found">
              <header>
                <h1 class="page-title">Not Found</h1>
              </header>
              <section class="post-content">
                <p>Sorry, but the requested posts were not found on this site.</p>
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