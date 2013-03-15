<div class="share-bottom-buttons">
  <a href="http://www.facebook.com/sharer.php?u=<?php if (is_front_page()) { print home_url(); } else { the_permalink(); } ?>" target="_blank" class="button btn-facebook">
    <span class="icon" aria-hidden="true" data-icon="&#xe001;"></span>
    <span class="button-text">Facebook</span>
  </a>
  <a href="http://twitter.com/share?text=<?php if (is_front_page()) { print 'Lifeboat: Friends at Their Best'; } else { the_title(); } ?>&url=<?php if (is_front_page()) { print home_url(); } else { the_permalink(); } ?>" target="_blank" class="button btn-twitter">
    <span class="icon" aria-hidden="true" data-icon="&#xe000;"></span>
    <span class="button-text">Twitter</span>
  </a>
</div><!-- share-bottom-buttons -->
