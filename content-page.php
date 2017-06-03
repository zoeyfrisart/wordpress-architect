<article class="page">
	
	<h2><?php the_title(); ?></h2>

  <p class="page-intro"><?php echo intro_get_meta( 'intro_intro' ); ?></p>

	<?php the_content(); ?>

  <div class="banner-image-full">
    <?php the_post_thumbnail('banner-image'); ?>
  </div>

</article>