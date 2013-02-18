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
    <?php $c++; endwhile; wp_reset_query(); ?>
  </ul>
</section><!-- #bottom-tabs -->
<?php endif; ?>