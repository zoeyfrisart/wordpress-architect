  <footer class="site-footer">
    <nav class="site-nav">
			<?php
			
			$args = array(
				'theme_location' => 'footer'
			);
			
			?>
			
			<?php wp_nav_menu(  $args ); ?>
		</nav>
    <i id="totop" class="fa fa-angle-up" aria-hidden="true"></i>
  </footer>
</div><!-- container -->
</body>
</html>