<div class="share">
  <span class="share-label">Share<?php print (is_front_page()) ? ' Lifeboat' : ''; ?></span>
  <span class="share-icons">
    <a href="http://www.facebook.com/sharer.php?u=<?php if (is_front_page()) { print home_url(); } else { the_permalink(); } ?>" target="_blank" class="icon icon-alone icon-fb content-share">
      <span aria-hidden="true" data-icon="&#xe016;"></span>
      <span class="screen-reader-text">Facebook</span>
    </a>
    <a href="http://twitter.com/share?text=<?php if (is_front_page()) { print 'Lifeboat: Friends at Their Best'; } else { the_title(); } ?>&url=<?php if (is_front_page()) { print home_url(); } else { the_permalink(); } ?>" target="_blank" class="icon icon-alone icon-tw content-share">
      <span aria-hidden="true" data-icon="&#xe018;"></span>
      <span class="screen-reader-text">Twitter</span>
    </a>
    <a href="mailto:?subject=<?php if (is_front_page()) { print 'Lifeboat: Friends at Their Best'; } else { the_title(); if (get_field('subtitle')) { echo '%20&mdash;%20'; the_field('subtitle'); } } ?>&body=Hi,%0D%0A%0D%0AI just found this on http://getlifeboat.com and thought you'd like it:%0D%0A%0D%0A<?php if (is_front_page()) { print 'Lifeboat: Friends at Their Best'; } else { the_title(); } ?>%0D%0A<?php if (is_front_page()) { print home_url(); } else { the_permalink(); } if (get_field('subtitle')) { echo "%0D%0A%0D%0A*"; the_field('subtitle'); echo "*"; } ?>%0D%0A%0D%0ACheers,%0D%0A" target="_blank" class="icon icon-alone icon-email content-share">
      <span aria-hidden="true" data-icon="&#xe028;"></span>
      <span class="screen-reader-text">Email</span>
    </a>
  </span><!-- share-icons -->
</div><!-- share -->