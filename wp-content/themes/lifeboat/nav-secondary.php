		    <?php $subpages = ($post->post_parent) ? wp_list_pages('title_li=&child_of='.$post->post_parent.'&depth=1&echo=0') : wp_list_pages('title_li=&child_of='.$post->ID.'&depth=1&echo=0');
              if($subpages) : ?>
  		  <nav id="secondary">
  		    <ul class="clearfix">
            <?php print $subpages; ?>
          </ul>
  		  </nav><!-- secondary -->
        <?php endif; ?>