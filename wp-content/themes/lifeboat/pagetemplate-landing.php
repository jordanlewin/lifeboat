<?php
/*
Template Name: Landing Page
*/
?>

<?php get_header(); ?>
      
    <div class="row">
      <section id="main" class="thirteen columns offset-by-one push-four">

        <?php get_template_part('nav', 'secondary'); ?>
        
        <div id="main-content" class="content-page template-landing">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
          <header<?php print (get_field('banner_title')) ? ' class="with-banner-title"' : ''; ?>>
            <?php if (has_post_thumbnail()): ?>
            <div id="img-vid">
              <?php the_post_thumbnail('lifeboat-banner'); ?>
            </div><!-- img-vid -->
            <?php endif; ?>
            <h1 class="<?php print (get_field('banner_title')) ? 'banner' : 'page'; ?>-title"><?php if (get_field('banner_title')) { echo '<span class="title-inner">'; the_field('banner_title'); echo '</span><span class="corner-flap"></span>'; } else { the_title(); } ?></h1>
          </header>
          <section class="row">
            <div id="content" class="<?php print (get_field('action_area')) ? 'nine' : 'eighteen'; ?> columns">
              <?php if(get_field('subtitle')) : ?>
              <h3 class="subtitle"><?php the_field('subtitle'); ?></h3>
              <?php endif; ?>
              <?php the_content(); ?>
            </div><!-- nine or eighteen columns -->

            <?php if ($field_count = count(get_field("action_area"))): ?>
            <div id="landing-action" class="nine columns">
              <div class="landing-action-arrow"></div>
              <div class="landing-action-content">
                <?php if ($field_count > 1): ?>
                
                <dl class="tabs">
                  <?php $c = 1; while(has_sub_field("action_area")): ?>
                  <?php if(get_row_layout() == "action"): ?>
                  <dd<?php print ($c == 1) ? ' class="active"' : ''; ?>><a href="#action<?php print $c; ?>"><?php the_sub_field("action_title"); ?></a></dd>
                  <?php endif; ?>
                  <?php $c++; endwhile; ?>
                </dl>
                <ul class="tabs-content">
                  <?php $c = 1; while(has_sub_field("action_area")): ?>
                  <?php if(get_row_layout() == "action"): ?>
                  <li<?php print ($c == 1) ? ' class="active"' : ''; ?> id="action<?php print $c; ?>Tab"><?php the_sub_field("action_content"); ?></li>
                  <?php endif; ?>
                  <?php $c++; endwhile; ?>
                </ul>
                
                <?php else: ?>
                
                <?php while(has_sub_field("action_area")): ?>
                <?php if(get_row_layout() == "action"): ?>
                <?php if(get_sub_field("action_title")): ?>
                <h3><?php the_sub_field("action_title"); ?></h3>
                <?php endif; ?>
                <?php the_sub_field("action_content"); ?>
                <?php endif; ?>
                <?php endwhile; ?>
                
                <?php endif; ?>
              </div><!-- landing-action-content -->
            </div><!-- #landing-action nine columns landing-action -->
            <?php endif; ?>

          </section><!-- row content -->
        </article><!-- type-page -->
        
        <?php endwhile; ?>
        <?php else: ?>
        
        <?php get_template_part('post-not-found'); ?>
        
        <?php endif; ?>
        
        <?php if (get_field("bottom_tabs")): ?>
        <section id="bottom-tabs">
          <dl class="tabs">
            <?php $c = 1; while(has_sub_field("bottom_tabs")): ?>
            <?php if(get_row_layout() == "bottom_tab"): ?>
            <dd<?php print ($c == 1) ? ' class="active"' : ''; ?>><a href="#bottom<?php print $c; ?>"><?php the_sub_field("bottom_tab_title"); ?></a></dd>
            <?php endif; ?>
            <?php $c++; endwhile; ?>
          </dl>
          <ul class="tabs-content content">
            <?php $c = 1; while(has_sub_field("bottom_tabs")): ?>
            <?php if(get_row_layout() == "bottom_tab"): ?>
            <li<?php print ($c == 1) ? ' class="active"' : ''; ?> id="bottom<?php print $c; ?>Tab"><?php the_sub_field("bottom_tab_content"); ?></li>
            <?php endif; ?>
            <?php $c++; endwhile; ?>
          </ul>
        </section><!-- #bottom-tabs -->
        <?php endif; ?>
      
        </div><!-- main-content content-page -->
      </section><!-- main -->
    
      <?php get_sidebar(); ?>
      
    </div><!-- row -->

<?php get_footer(); ?>