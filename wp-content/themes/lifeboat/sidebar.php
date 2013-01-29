      <section id="sidebar" class="four columns pull-fourteen" role="complementary">
        <?php if(is_front_page()) : ?>
        <h6 class="sidebar-label-title">Become an Insider</h6>
        <?php endif; ?>
        <?php if (is_active_sidebar('sidebar')) : ?>
          <?php dynamic_sidebar('sidebar'); ?>
        <?php else : ?>
        <!-- This content shows up if there are no widgets defined in the backend. -->
        <aside id="become-insider" class="widget">
          <p class="panel">Become an Insider Here</p>
        </aside><!-- become-insider -->
        <aside id="share-manifesto" class="widget">
          <p class="panel">Share the Manifesto Here</p>
        </aside><!-- share-manifesto -->
        <?php endif; ?>
      </section><!-- sidebar -->
    </div><!-- row -->