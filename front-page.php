<?php

get_header(); ?>
	
	<!-- site-content -->
	<div class="site-content clearfix" title="homepage">
    <?php get_sidebar(); ?>
    <div class="main-column">
			<?php if (have_posts()) :
				while (have_posts()) : the_post();
          
          get_template_part( 'categorythumbs');

				endwhile;

				else :
					echo '<p>No content found</p>';

				endif; ?>
				
        <?php 	
        $mypages = get_pages( array(
          'exclude' => '9', 'sort_column' => 'post_date', 'sort_order' => 'desc' 
        ) );
        foreach( $mypages as $page ) {
          $content = $page->post_content;
          if ( ! $content ) 		
          continue;
          $content = apply_filters( 'the_content', $content );?>
            <!-- post-thumbnail -->
              <div class="post-thumbnail homepage-thumb">
                <a href="<?php echo get_page_link( $page->ID ); ?>">
                <?php echo get_the_post_thumbnail( $page->ID , 'square-thumbnail');?></a>
              </div>
            <!-- /post-thumbnail -->
        <?php 	}	 ?>

			</div>
	</div><!-- /site-content -->
	
	<?php get_footer();

?>