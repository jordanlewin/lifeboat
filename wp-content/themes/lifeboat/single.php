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
                <div class="by"><small>Words By</small> <?php the_author_posts_link(); ?></div>
                <?php if (get_field("attributions")): ?>
                <?php while(has_sub_field("attributions")): ?>
                <?php if(get_row_layout() == "attribution"): ?>
                <div class="by"><small><?php the_sub_field("attribution_label"); ?></small> <?php if (get_sub_field("attribution_link")) : ?><a href="<?php the_sub_field("attribution_link"); ?>" target="_blank"><?php endif; ?><?php the_sub_field("attribution_name"); ?><?php if (get_sub_field("attribution_link")) : ?></a><?php endif; ?></div>
                <?php endif; ?>
                <?php endwhile; ?>
                <?php endif; ?>
                <!-- <div class="views"><small>635 Views</small></div> -->
              </div><!-- credits -->
              <?php get_template_part('share', 'icons'); ?>
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
              <?php get_template_part('share', 'buttons'); ?>
            </div><!-- share-bottom -->
            <div id="comments">
              <h2>What do you think?</h2>
              <div class="disqus-comments">
                <?php comments_template(); ?>
              </div><!-- disqus-comments -->
            </div><!-- comments -->

            <?php get_template_part('references'); ?>
            
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