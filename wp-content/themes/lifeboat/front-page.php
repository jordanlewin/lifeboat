<?php get_header(); ?>
      
    <!-- Begin Custom Homepage Markup -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="row">
      <section id="home-intro" class="thirteen columns offset-by-five">
      <?php the_content(); ?>
      <div class="home-buttons">
        <a href="/get-started/" class="button small">Start Now</a>
        <div class="share">
          <span class="share-label">Share Lifeboat</span>
          <!-- <a href="" class="icon-fb" aria-hidden="true" data-icon="&#xe012;">Facebook</a>
          <a href="" class="icon-tw">Twitter</a>
          <a href="" class="icon-email">Email</a> -->
          <a href="" class="icon icon-alone icon-fb">
            <span aria-hidden="true" data-icon="&#xe016;"></span>
            <span class="screen-reader-text">Facebook</span>
          </a>
          <a href="" class="icon icon-alone icon-tw">
            <span aria-hidden="true" data-icon="&#xe018;"></span>
            <span class="screen-reader-text">Twitter</span>
          </a>
          <a href="" class="icon icon-alone icon-email">
            <span aria-hidden="true" data-icon="&#xf0e0;"></span>
            <span class="screen-reader-text">Email</span>
          </a>
        </div><!-- share -->
      </div><!-- home-buttons -->      </section><!-- home-intro -->
    </div><!-- row -->
    <?php endwhile; endif; ?>

    <div class="row">
      <section id="main" class="thirteen columns offset-by-one push-four">
        <div id="content" class="content-home">
          <h6 class="label-title">From the Friend Blog</h6>
          
          <?php global $query_string;
                query_posts($query_string . '&posts_per_page=1&featured=yes');
                if (have_posts()) : while (have_posts()) : the_post(); ?>
          
          <article <?php (has_post_thumbnail()) ? post_class('post-teaser clearfix with-image') : post_class('post-teaser clearfix'); ?> role="article">
            <a href="<?php the_permalink(); ?>" class="post-link">
              <div class="post-image">
                <?php the_post_thumbnail('lifeboat-index'); ?>
              </div><!-- post-image -->
              <div class="post-content">
                <h2><?php the_title(); ?></h2>
                <?php if(get_field('subtitle')) : ?>
                <h4 class="subtitle"><?php the_field('subtitle'); ?></h4>
                <?php endif; ?>
                <span data-href="/friend-blog/" id="more-from-blog" class="button small">More from the Friend Blog</span>
              </div><!-- post-content -->
            </a><!-- blog-post-link -->
            <!-- <a href="/friend-blog/" id="more-from-blog" class="button small">More from the Friend Blog</a> -->
          </article><!-- blog-post -->

          <?php endwhile; wp_reset_query(); ?>
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
    <!-- End Custom Homepage Markup -->

<?php get_footer(); ?>