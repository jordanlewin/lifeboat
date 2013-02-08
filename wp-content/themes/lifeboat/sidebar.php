      <section id="sidebar" class="four columns pull-fourteen" role="complementary">
        <?php if(is_front_page()) : ?>
        <h6 class="label-title">Become an Insider</h6>
        <?php endif; ?>
        <?php if (is_active_sidebar('sidebar')) : ?>
          <?php dynamic_sidebar('sidebar'); ?>
        <?php else : ?>
        <!-- This content shows up if there are no widgets defined in the backend. -->
        <aside id="widget-text-2" class="widget widget_text">
          <h4 class="widget-title">Join us on a journey to better friendship.</h4>
          <div class="textwidget">
            <hr>
            <p>Get fresh friend advice.</p>
            <a href="/become-an-insider/" class="button">Become an Insider</a>
          </div>
        </aside>
        <?php endif; ?>
      </section><!-- sidebar -->
    </div><!-- row -->