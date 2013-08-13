<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>
    </div> <!-- end of content -->
    
    <!--[if gte IE 6]>
<div id="footer-container">
<![endif]-->
    
    <footer id="footer-container">
      <section class="container">
        <div class="row">
          <div style="float:left;">
            <?php wp_footer_nav_menu(array(
                    'theme_location'  => 'nav-footer',
                    'container_class' => 'title-container',
                    'container_id'    => 'footer-nav',
                    'depth'           => '2',
                    'container'       => 'nav'
                  )); ?>
          </div>
          <div class="credit">
            <span>Theme by <a href="http://www.hannaliebl.com">Hanna Liebl</a> and <a href="http://coding-contemplation.blogspot.com/">Cyrus Smith</a><br/></span>
            <span>With <a href="http://wordpress.org/">WordPress</a> and <a href="http://html5boilerplate.com/">HTML5 Boilerplate</a><br /></span>
            <span><a href="<?php echo wp_login_url(); ?>" title="Login">Site Login</a></span>
            <!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
          </div>
        </div>
      </section>
    </footer>
        <!--[if gte IE 6]>
</div>
<![endif]-->

    <!-- Javascript at the bottom for fast page loading -->

    <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $GLOBALS["TEMPLATE_RELATIVE_URL"] ?>js/vendor/jquery-1.8.0.min.js"><\/script>')</script>

    <!-- end of footer -->
    <?php wp_footer(); ?>
  </body>
</html>
