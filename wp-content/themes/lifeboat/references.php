<?php if(get_field('references')): ?>
<section id="refs">
  <h4 class="label-title">References</h4>
  <a href="#top" class="top-link">Back to Top <span class="icon" aria-hidden="true" data-icon="&#xe00d;"></span></a>
  <?php the_field('references'); ?>
</section><!-- refs -->
<?php endif; ?>