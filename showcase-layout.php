<?php

/*
Template Name: Showcase subpages layout
*/

get_header(); ?>

	<!-- site-content -->
	<div class="site-content clearfix">
		
    <?php get_sidebar(); ?>
		<!-- main-column -->
		<div class="main-column">
			
			<?php 	
        $mypages = get_pages( array(
          'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' 
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

			
		</div><!-- /main-column -->
		
	</div><!-- /site-content -->

<?php get_footer();

?>