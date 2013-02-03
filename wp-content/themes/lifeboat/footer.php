  <!-- Begin Custom Footer Markup -->
  </div><!-- main-container container -->
  
  <div id="footer-container" class="container">
    <footer id="footer" class="row">
      <div class="eighteen columns">
        <div id="footer-first">
          <span class="lifeboat-flag"><img src="<?php echo get_template_directory_uri(); ?>/images/tagline-flag.png" alt="Lifeboat // Friends At Their Best" width="308" /></span>
          <span class="copyright">&copy; <?php print date("Y"); ?></span>
          <span class="from">
            <span class="hearts-minds">From the Minds and Hearts of:</span> 
            <span class="name">
              <span class="first-name">Alia</span> <span class="last-name">McKee</span> 
            </span><!-- name -->
            <span class="plus">+</span> 
            <span class="name">
              <span class="first-name">Tim</span> <span class="last-name">Walker</span>
            </span><!-- name -->
          </span><!-- from -->
          <span class="contact-us"><a href="/about/contact-us/" class="button small highlight">Contact Us</a></span>
        </div><!-- footer-first -->
        <div id="footer-second">
          <span class="text">You Checkin’ Out Our Footer? Congrats!</span> <span class="link"><a href="">Get Your Random Friend Song</a></span>
          <?php //bones_footer_links(); ?>
        </div><!-- footer-second -->
      </div><!-- eighteen columns -->
    </footer><!-- footer row -->
  </div><!-- footer-container container -->
  <!-- End Custom Footer Markup -->
    
  <!--[if lt IE 7 ]>
      <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
      <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
  <!-- wordpress footer functions -->
  <?php wp_footer(); // js scripts are inserted using this function ?>
  <!-- end of wordpress footer -->

</body>
</html>